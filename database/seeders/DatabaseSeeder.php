<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user_roles = UserRole::cases();

        collect($user_roles)->map(function ($role) {
            Role::create([
                'name' => $role->value
            ]);
        });

        $admin_user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('1234'),
        ]);

        $admin_role = Role::where('name', UserRole::AD->value)->first();

        $admin_user->assignRole($admin_role);
    }
}
