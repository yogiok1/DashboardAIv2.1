<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AggregateSettingController;
use App\Http\Controllers\AITrainingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\ExternalSourceController;
use App\Http\Controllers\ModelAIController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProposalGroupController;
use App\Http\Controllers\ProposalGroupResultController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\ToolsController;
use App\Models\Proposal;

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Chatbot
    Route::get('/chatbot', [AdminController::class, 'chatbot'])->name('chatbot');

    // Help / User Guide
    Route::get('/help', [AdminController::class, 'help'])->name('help');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::get('/users/roles', [AdminController::class, 'userRoles'])->name('users.roles');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::get('/products/categories', [AdminController::class, 'productCategories'])->name('products.categories');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/pending', [AdminController::class, 'pendingOrders'])->name('orders.pending');
    Route::get('/orders/completed', [AdminController::class, 'completedOrders'])->name('orders.completed');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

    // Users Routes - menggunakan UserController
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Role & Permission Routes
    Route::get('/role-permission-management', [RolePermissionController::class, 'index'])->name('role-permission.index');

    // Role Routes
    Route::get('/roles/create', [RolePermissionController::class, 'createRole'])->name('roles.create');
    Route::post('/roles', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::get('/roles/{role}', [RolePermissionController::class, 'showRole'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RolePermissionController::class, 'editRole'])->name('roles.edit');
    Route::put('/roles/{role}', [RolePermissionController::class, 'updateRole'])->name('roles.update');
    Route::delete('/roles/{role}', [RolePermissionController::class, 'destroyRole'])->name('roles.destroy');

    // Permission Routes
    // Enhanced Permission Routes
    Route::get('/permissions/create', [RolePermissionController::class, 'createPermission'])->name('permissions.create');
    Route::post('/permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::get('/permissions/generate', [RolePermissionController::class, 'generatePermissions'])->name('permissions.generate');
    Route::post('/permissions/generate', [RolePermissionController::class, 'storeGeneratedPermissions'])->name('permissions.store-generated');
    Route::get('/permissions/{permission}/edit', [RolePermissionController::class, 'editPermission'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [RolePermissionController::class, 'updatePermission'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');
    Route::post('/permissions/bulk-delete', [RolePermissionController::class, 'bulkDeletePermissions'])->name('permissions.bulk-delete');

    // Bulk Delete Routes - SIMPLE
    Route::post('/roles/bulk-delete', [RolePermissionController::class, 'bulkDeleteRoles'])->name('roles.bulk-delete');
    Route::post('/permissions/bulk-delete', [RolePermissionController::class, 'bulkDeletePermissions'])->name('permissions.bulk-delete');
});


Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index');
Route::post('/proposals', [ProposalController::class, 'store'])->name('proposals.store');

Route::get('/proposal-groups', [ProposalGroupController::class, 'index'])->name('proposal-groups.index');
Route::post('/proposal-groups', [ProposalGroupController::class, 'store'])->name('proposal-groups.store');
Route::get('/proposal-groups/{group}', [ProposalGroupController::class, 'show'])->name('proposal-groups.show');

Route::get('/rubrics', [RubricController::class, 'index'])->name('rubrics.index');
Route::post('/rubrics/upload', [RubricController::class, 'store'])->name('rubrics.store');
Route::delete('/rubrics/{id}', [RubricController::class, 'destroy'])->name('rubrics.destroy');

Route::resource('metadata', MetadataController::class);
Route::resource('extras', ExtraController::class)->only(['index', 'store', 'destroy']);

// External Sources (PDF Books for AI Training)
Route::resource('external-sources', ExternalSourceController::class)->only(['index', 'store', 'destroy']);

// Tools Routes - AI Testing Center
Route::get('/tools', [ToolsController::class, 'index'])->name('tools');
Route::get('/tools/test/{type}', [ToolsController::class, 'test'])->name('tools.test');
Route::post('/tools/run', [ToolsController::class, 'run'])->name('tools.run');



Route::get('/inputData', function () {
    return view('inputData.index');
})->name('inputData');


Route::get('/modelai', [ModelAIController::class, 'index'])->name('modelai.index');
Route::post('/modelai', [ModelAIController::class, 'store'])->name('modelai.store');

Route::get('/ai-training', [AITrainingController::class, 'index'])->name('ai-training.index');
Route::post('/ai-training', [AITrainingController::class, 'store'])->name('ai-training.store');

Route::get('/aggregate-settings', [AggregateSettingController::class, 'index'])->name('aggregate.index');
Route::post('/aggregate-settings', [AggregateSettingController::class, 'store'])->name('aggregate.store');

Route::get('/proposal-results', [ProposalGroupResultController::class, 'index'])->name('results.index');
Route::post('/proposal-results', [ProposalGroupResultController::class, 'store'])->name('results.store');

// Detail proposal dalam group
Route::get('/proposal-results/{id}/detail', [ProposalGroupResultController::class, 'detail'])->name('results.detail');
