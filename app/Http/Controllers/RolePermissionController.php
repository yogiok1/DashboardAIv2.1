<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk roles dengan search, filter, dan sorting
        $rolesQuery = Role::withCount(['users', 'permissions'])->with('permissions');

        // Search filter untuk roles
        if ($request->has('role_search') && $request->role_search != '') {
            $search = $request->role_search;
            $rolesQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            });
        }

        // Role type filter
        if ($request->has('role_type') && $request->role_type != 'all') {
            if ($request->role_type == 'system') {
                $rolesQuery->whereIn('name', ['super-admin', 'admin']);
            } elseif ($request->role_type == 'custom') {
                $rolesQuery->whereNotIn('name', ['super-admin', 'admin']);
            }
        }

        // Sorting untuk roles
        $roleSortField = $request->get('role_sort', 'name');
        $roleSortDirection = $request->get('role_direction', 'asc');

        $allowedRoleSortFields = ['name', 'guard_name', 'created_at'];
        if (!in_array($roleSortField, $allowedRoleSortFields)) {
            $roleSortField = 'name';
        }

        if (!in_array($roleSortDirection, ['asc', 'desc'])) {
            $roleSortDirection = 'asc';
        }

        $rolesQuery->orderBy($roleSortField, $roleSortDirection);

        // Query untuk permissions dengan search, filter, dan sorting
        $permissionsQuery = Permission::withCount('roles')->with('roles');

        // Search filter untuk permissions
        if ($request->has('permission_search') && $request->permission_search != '') {
            $search = $request->permission_search;
            $permissionsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('guard_name', 'like', "%{$search}%");
            });
        }

        // Permission assignment filter
        if ($request->has('permission_assignment') && $request->permission_assignment != 'all') {
            if ($request->permission_assignment == 'assigned') {
                $permissionsQuery->has('roles');
            } elseif ($request->permission_assignment == 'unassigned') {
                $permissionsQuery->doesntHave('roles');
            }
        }

        // Sorting untuk permissions
        $permissionSortField = $request->get('permission_sort', 'name');
        $permissionSortDirection = $request->get('permission_direction', 'asc');

        $allowedPermissionSortFields = ['name', 'guard_name', 'created_at'];
        if (!in_array($permissionSortField, $allowedPermissionSortFields)) {
            $permissionSortField = 'name';
        }

        if (!in_array($permissionSortDirection, ['asc', 'desc'])) {
            $permissionSortDirection = 'asc';
        }

        $permissionsQuery->orderBy($permissionSortField, $permissionSortDirection);

        // Pagination
        $rolePerPage = $request->get('role_per_page', 6);
        $permissionPerPage = $request->get('permission_per_page', 9);

        $allowedPerPage = [6, 9, 12, 18, 24];
        if (!in_array($rolePerPage, $allowedPerPage)) {
            $rolePerPage = 6;
        }
        if (!in_array($permissionPerPage, $allowedPerPage)) {
            $permissionPerPage = 9;
        }

        $roles = $rolesQuery->paginate($rolePerPage, ['*'], 'roles_page');
        $permissions = $permissionsQuery->paginate($permissionPerPage, ['*'], 'permissions_page');

        // Append query parameters untuk pagination
        $roles->appends($request->except('roles_page'));
        $permissions->appends($request->except('permissions_page'));

        // Group permissions by module
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            return $this->extractModuleName($permission->name);
        });

        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'total_users' => User::count(),
            'total_modules' => $groupedPermissions->count(),
            'unused_permissions' => Permission::doesntHave('roles')->count(),
        ];

        return view('admin.roles-permissions.index', compact('roles', 'permissions', 'groupedPermissions', 'stats'));
    }
    // ... method createRole, storeRole, editRole, updateRole, destroyRole tetap sama ...
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

    public function showRole(Role $role, Request $request)
    {
        // Load relationships
        $role->load(['permissions'])->loadCount(['users', 'permissions']);

        // Get users with this role with pagination
        $usersQuery = User::whereHas('roles', function ($query) use ($role) {
            $query->where('id', $role->id);
        });

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $usersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status != 'all') {
            $usersQuery->where('status', $request->status);
        }

        // Sort
        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');

        $allowedSortFields = ['name', 'email', 'created_at', 'status'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'name';
        }

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $usersQuery->orderBy($sortField, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $users = $usersQuery->paginate($perPage);

        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        return view('admin.roles-permissions.show', compact('role', 'users', 'stats'));
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
    //

    public function createPermission()
    {
        $modules = $this->getAvailableModules();
        $commonActions = $this->getCommonActions();

        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        return view('admin.roles-permissions.create-permission', compact('modules', 'commonActions', 'stats'));
    }

    public function storePermission(Request $request)
    {
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
            'actions' => 'required|array|min:1',
            'actions.*' => 'string|max:50',
            'guard_name' => 'required|string|in:web,api'
        ]);

        $createdPermissions = [];

        try {
            foreach ($request->actions as $action) {
                $permissionName = $request->module . '.' . $action;

                // Check if permission already exists
                if (!Permission::where('name', $permissionName)->exists()) {
                    $permission = Permission::create([
                        'name' => $permissionName,
                        'guard_name' => $request->guard_name,
                    ]);
                    $createdPermissions[] = $permission->name;
                }
            }

            $message = count($createdPermissions) > 0
                ? 'Permissions created successfully: ' . implode(', ', $createdPermissions)
                : 'No new permissions were created (some may already exist)';

            return redirect()->route('role-permission.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create permissions: ' . $e->getMessage());
        }
    }

    public function generatePermissions()
    {
        $routes = app('router')->getRoutes()->getRoutes();
        $suggestedPermissions = [];

        foreach ($routes as $route) {
            if ($route->getName() && strpos($route->getName(), 'admin.') === 0) {
                $permissionName = str_replace('admin.', '', $route->getName());
                if (!Permission::where('name', $permissionName)->exists()) {
                    $suggestedPermissions[] = $permissionName;
                }
            }
        }

        $stats = [
            'total_permissions' => Permission::count(),
            'suggested_count' => count($suggestedPermissions),
        ];

        return view('admin.roles-permissions.generate-permissions', compact('suggestedPermissions', 'stats'));
    }

    public function storeGeneratedPermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'string|max:255',
            'guard_name' => 'required|string|in:web,api'
        ]);

        $createdCount = 0;

        foreach ($request->permissions as $permissionName) {
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => $request->guard_name,
                ]);
                $createdCount++;
            }
        }

        return redirect()->route('role-permission.index')
            ->with('success', "Successfully created {$createdCount} new permissions from routes.");
    }

    public function editPermission(Permission $permission)
    {
        $modules = $this->getAvailableModules();

        $stats = [
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        return view('admin.roles-permissions.edit-permission', compact('permission', 'modules', 'stats'));
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



    /**
     * Extract module name from permission name
     */
    private function extractModuleName($permissionName)
    {
        $parts = explode('.', $permissionName);
        return $parts[0] ?? 'general';
    }

    /**
     * Get available modules from existing permissions
     */
    private function getAvailableModules()
    {
        $permissions = Permission::all();
        $modules = $permissions->map(function ($permission) {
            return $this->extractModuleName($permission->name);
        })->unique()->values()->toArray();

        // Add common modules if not exists
        $commonModules = ['user', 'role', 'permission', 'setting', 'content', 'report', 'dashboard', 'profile'];
        $allModules = array_unique(array_merge($modules, $commonModules));

        sort($allModules);
        return $allModules;
    }

    /**
     * Get common actions for permissions
     */
    private function getCommonActions()
    {
        return [
            'view',
            'view-any',
            'create',
            'update',
            'delete',
            'restore',
            'force-delete',
            'export',
            'import',
            'publish',
            'unpublish',
            'approve',
            'reject',
            'manage'
        ];
    }

    // Bulk delete roles - SIMPLE VERSION
    public function bulkDeleteRoles(Request $request)
    {
        $roleIds = $request->role_ids ?? [];

        if (empty($roleIds)) {
            return redirect()->back()->with('error', 'No roles selected for deletion.');
        }

        // Filter out system roles
        $systemRoles = ['super-admin', 'admin'];
        $deletableRoles = Role::whereIn('id', $roleIds)
            ->whereNotIn('name', $systemRoles)
            ->get();

        if ($deletableRoles->isEmpty()) {
            return redirect()->back()->with('error', 'No valid roles selected for deletion. System roles cannot be deleted.');
        }

        $deletedCount = 0;
        foreach ($deletableRoles as $role) {
            $role->delete();
            $deletedCount++;
        }

        return redirect()->back()->with('success', $deletedCount . ' roles deleted successfully.');
    }

    // Bulk delete permissions - SIMPLE VERSION
    public function bulkDeletePermissions(Request $request)
    {
        $permissionIds = $request->permission_ids ?? [];

        if (empty($permissionIds)) {
            return redirect()->back()->with('error', 'No permissions selected for deletion.');
        }

        // Only delete permissions not assigned to any role
        $deletablePermissions = Permission::whereIn('id', $permissionIds)
            ->whereDoesntHave('roles')
            ->get();

        if ($deletablePermissions->isEmpty()) {
            return redirect()->back()->with('error', 'No valid permissions selected for deletion. Permissions assigned to roles cannot be deleted.');
        }

        $deletedCount = 0;
        foreach ($deletablePermissions as $permission) {
            $permission->delete();
            $deletedCount++;
        }

        return redirect()->back()->with('success', $deletedCount . ' permissions deleted successfully.');
    }
}
