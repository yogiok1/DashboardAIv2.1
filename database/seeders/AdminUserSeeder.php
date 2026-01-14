<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role 'admin' sudah ada
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Cek apakah user admin sudah ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.app'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin'), // ubah sesuai keinginan
                'status' => 'active',
            ]
        );

        // Assign role admin ke user
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($role);
        }

        // Output ke console
        $this->command->info('✅ User admin dibuat & diberi role admin');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password123');
    }
}
