@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stats-card title="Total Users" value="1,234" icon="fas fa-users" iconBg="bg-primary-100" iconColor="text-primary-600"
            borderColor="border-primary-500" trend="12.5" />

        <x-stats-card title="Total Products" value="567" icon="fas fa-box" iconBg="bg-green-100" iconColor="text-green-600"
            borderColor="border-green-500" trend="8.2" />

        <x-stats-card title="Total Orders" value="892" icon="fas fa-shopping-cart" iconBg="bg-blue-100"
            iconColor="text-blue-600" borderColor="border-blue-500" trend="15.3" />

        <x-stats-card title="Revenue" value="$12,456" icon="fas fa-dollar-sign" iconBg="bg-purple-100"
            iconColor="text-purple-600" borderColor="border-purple-500" trend="22.4" />
    </div>

    <!-- Content lainnya -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
                <a href=" " class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @for ($i = 0; $i < 5; $i++)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-primary-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Order #ORD{{ 1000 + $i }}</p>
                                <p class="text-sm text-gray-500">Just now</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                            Completed
                        </span>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
                <a href=" " class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @for ($i = 0; $i < 5; $i++)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-primary-600 font-semibold">U</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">User {{ $i + 1 }}</p>
                                <p class="text-sm text-gray-500">user{{ $i + 1 }}@example.com</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">2 hours ago</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-6">Quick Actions</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href=" "
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-colors group">
                <i class="fas fa-user-plus text-2xl text-gray-400 group-hover:text-primary-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-600 group-hover:text-primary-700">Add User</span>
            </a>

            <a href=" "
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-colors group">
                <i class="fas fa-plus-circle text-2xl text-gray-400 group-hover:text-primary-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-600 group-hover:text-primary-700">Add Product</span>
            </a>

            <a href=" "
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-colors group">
                <i class="fas fa-file-invoice text-2xl text-gray-400 group-hover:text-primary-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-600 group-hover:text-primary-700">Create Order</span>
            </a>

            <a href=" "
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-colors group">
                <i class="fas fa-cogs text-2xl text-gray-400 group-hover:text-primary-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-600 group-hover:text-primary-700">Settings</span>
            </a>
        </div>
    </div>

@endsection
