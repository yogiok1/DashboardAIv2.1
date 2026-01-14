<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Pastikan role 'user' sudah ada
        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);

        // Buat 10 user dan assign role user
        User::factory(10)->create()->each(function ($user) use ($role) {
            $user->assignRole($role);
        });


        $this->call([
            RoleSeeder::class,        // kalau kamu sudah punya seeder role
            AdminUserSeeder::class,   // seeder yang baru kita buat
        ]);
    }
}
