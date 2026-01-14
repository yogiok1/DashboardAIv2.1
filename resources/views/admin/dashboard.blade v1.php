@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stats-card
            title="Total Users"
            value="12,456"
            icon="fas fa-users"
            trend="12.5"
            color="blue"
        />

        <x-stats-card
            title="Total Revenue"
            value="$45.2K"
            icon="fas fa-dollar-sign"
            trend="8.2"
            color="green"
        />

        <x-stats-card
            title="Total Orders"
            value="4,892"
            icon="fas fa-shopping-cart"
            trend="15.3"
            color="purple"
        />

        <x-stats-card
            title="Conversion Rate"
            value="24.8%"
            icon="fas fa-chart-line"
            trend="22.4"
            color="orange"
        />
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-card border border-gray-200 p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Revenue Overview</h3>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        Week
                    </button>
                    <button class="px-3 py-1.5 text-xs font-medium bg-primary-50 text-primary-700 rounded-lg transition-colors duration-200">
                        Month
                    </button>
                    <button class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        Year
                    </button>
                </div>
            </div>
            <!-- Chart placeholder -->
            <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                <p class="text-gray-500">Revenue chart will be displayed here</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-card border border-gray-200 p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors duration-200">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @for($i = 0; $i < 5; $i++)
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-primary-600 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800">New user registration</p>
                        <p class="text-xs text-gray-500 mt-1">Just now</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Recent Orders & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-card border border-gray-200 p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
                <a href=" " class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors duration-200">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @for($i = 0; $i < 5; $i++)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200 border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-primary-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Order #ORD{{ 1000 + $i }}</p>
                            <p class="text-sm text-gray-500">Customer {{ $i + 1 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2.5 py-1 bg-success-100 text-success-800 text-xs font-medium rounded-full">
                            Completed
                        </span>
                        <p class="text-sm font-medium text-gray-800 mt-1">${{ rand(50, 500) }}</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-xl shadow-card border border-gray-200 p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Top Products</h3>
                <a href=" " class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors duration-200">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @for($i = 0; $i < 5; $i++)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200 border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Product {{ $i + 1 }}</p>
                            <p class="text-sm text-gray-500">{{ rand(100, 500) }} sales</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2.5 py-1 bg-primary-100 text-primary-800 text-xs font-medium rounded-full">
                            ${{ rand(20, 200) }}
                        </span>
                    </div>
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
