<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])->with('permissions')->get();
        $permissions = Permission::withCount('roles')->with('roles')->get();

        $stats = [
            'total_roles' => $roles->count(),
            'total_permissions' => $permissions->count(),
            'total_users' => User::count(),
        ];

        return view('admin.roles-permissions.index', compact('roles', 'permissions', 'stats'));
    }

    public function createRole()
    {
        $permissions = Permission::all();
        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => $permissions->count(),
        ];

        return view('admin.roles-permissions.create-role', compact('permissions', 'stats'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|in:web,api',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        if ($request->has('permissions')) {
            // Dapatkan permission names berdasarkan IDs
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('role-permission.index')->with('success', 'Role created successfully!');
    }

    public function editRole(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');

        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => $permissions->count(),
        ];

        return view('admin.roles-permissions.edit-role', compact('role', 'permissions', 'stats'));
    }

    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'guard_name' => 'required|string|in:web,api',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        if ($request->has('permissions')) {
            // Dapatkan permission names berdasarkan IDs
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissionNames);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('role-permission.index')->with('success', 'Role updated successfully!');
    }

    public function destroyRole(Role $role)
    {
        // Prevent deletion of system roles
        if (in_array($role->name, ['super-admin', 'admin'])) {
            return redirect()->back()->with('error', 'System roles cannot be deleted.');
        }

        $role->delete();

        return redirect()->route('role-permission.index')->with('success', 'Role deleted successfully!');
    }

    public function createPermission()
    {
        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        return view('admin.roles-permissions.create-permission', compact('stats'));
    }

    public function storePermission(Request $request)
    {
        // Debug data yang masuk
        \Log::info('Permission Store Request:', $request->all());

        // Mode single permission
        if ($request->has('single_mode')) {
            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
                'guard_name' => 'required|string|in:web,api'
            ]);

            Permission::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            return redirect()->route('role-permission.index')->with('success', 'Permission created successfully!');
        }

        // Mode bulk permissions (module + actions)
        $request->validate([
            'module' => 'required|string|max:50',
            'guard_name' => 'required|string|in:web,api',
            'actions' => 'required|array|min:1',
        ]);

        // Validasi manual untuk actions
        $validActions = [];
        foreach ($request->actions as $index => $action) {
            $action = trim($action);
            if (!empty($action) && strlen($action) <= 50) {
                $validActions[] = $action;
            }
        }

        if (count($validActions) === 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please provide at least one valid action.');
        }

        $created = [];
        $skipped = [];

        foreach ($validActions as $action) {
            $permissionName = $request->module . '.' . $action;

            if (Permission::where('name', $permissionName)->doesntExist()) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => $request->guard_name
                ]);
                $created[] = $permissionName;
            } else {
                $skipped[] = $permissionName;
            }
        }

        $messages = [];
        if (!empty($created)) {
            $messages[] = 'Created ' . count($created) . ' permissions: ' . implode(', ', $created);
        }
        if (!empty($skipped)) {
            $messages[] = 'Skipped ' . count($skipped) . ' existing permissions';
        }

        $message = !empty($messages) ? implode(' | ', $messages) : 'No permissions were created.';

        return redirect()->route('role-permission.index')->with(
            !empty($created) ? 'success' : 'info',
            $message
        );
    }

    public function editPermission(Permission $permission)
    {
        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        return view('admin.roles-permissions.edit-permission', compact('permission', 'stats'));
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string|in:web,api'
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('role-permission.index')->with('success', 'Permission updated successfully!');
    }

    public function destroyPermission(Permission $permission)
    {
        // Prevent deletion if permission is assigned to roles
        if ($permission->roles()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete permission that is assigned to roles.');
        }

        $permission->delete();

        return redirect()->route('role-permission.index')->with('success', 'Permission deleted successfully!');
    }
}
