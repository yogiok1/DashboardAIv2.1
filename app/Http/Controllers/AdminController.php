<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function chatbot()
    {
        return view('admin.chatbot');
    }

    public function help()
    {
        return view('admin.help');
    }

    // Users
    public function users()
    {
        return view('admin.users.index');
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function userRoles()
    {
        return view('admin.users.roles');
    }

    // Products
    public function products()
    {
        return view('admin.products.index');
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function productCategories()
    {
        return view('admin.products.categories');
    }

    // Orders
    public function orders()
    {
        return view('admin.orders.index');
    }

    public function pendingOrders()
    {
        return view('admin.orders.pending');
    }

    public function completedOrders()
    {
        return view('admin.orders.completed');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
