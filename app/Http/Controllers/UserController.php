<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Stats data
        // $stats = [
        //     'total_users' => User::count(),
        //     'active_users' => User::where('status', 'active')->count(),
        //     'new_this_month' => User::whereMonth('created_at', now()->month)->count(),
        //     'admins' => User::where('role', 'admin')->count(),
        // ];
         $stats = [
        'total_users' => User::count(),
        'active_users' => User::where('status', 'active')->count(),
        'new_this_month' => User::whereMonth('created_at', now()->month)->count(),
        'engagement_rate' => 78, // Contoh data
        'total_growth' => 12.5, // Contoh growth positif
        'active_growth' => 8.3,  // Contoh growth positif
        'monthly_growth' => -5.2, // Contoh decline
        'engagement_growth' => 15.7, // Contoh growth positif
    ];

        // Query users dengan pagination, sorting, dan filtering
        $query = User::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        // Status filter
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Validasi field sorting untuk mencegah SQL injection
        $allowedSortFields = ['name', 'email', 'role', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $query->orderBy($sortField, $sortDirection);

        // Perpage
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $users = $query->with('roles')->paginate($perPage);
        $users->appends($request->except('page')); // Preserve semua parameter

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'stats', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => $request->password_option === 'custom' ? 'required|string|min:8|confirmed' : 'nullable',
            'status' => 'required|in:active,inactive,suspended',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name'
        ]);

        // Handle password generation
        $password = $request->password_option === 'random'
            ? Str::random(12) // Or use your preferred generation method
            : $request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'status' => $request->status,
        ]);

        // Assign roles jika ada
        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        } else {
            // Default role 'user'
            $user->assignRole('user');
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => $request->password_option !== 'keep' ? 'required|string|min:8|confirmed' : 'nullable',
            'status' => 'required|in:active,inactive,suspended',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name'
        ]);

        // Prepare update data
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ];

        // Handle password update if needed
        if ($request->password_option !== 'keep') {
            $password = $request->password_option === 'random'
                ? Str::random(12)
                : $request->password;

            $updateData['password'] = Hash::make($password);
        }

        // Update user
        $user->update($updateData);

        // Sync roles
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            // If no roles selected, remove all roles
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found.');
        }

        // Cek dengan cara yang aman
        $authUser = Auth::user();

        if ($authUser && $user->id === $authUser->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', "User {$userName} deleted successfully.");
    }
}
