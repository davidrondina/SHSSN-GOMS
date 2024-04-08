<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Faculty;
use App\Models\Profile;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fac_role = Role::where('name', UserRole::FA->value)->first();

        $user = User::create([
            'email' => 'faculty@test.com',
            'password' => Hash::make('1234'),
        ]);

        $user->assignRole($fac_role);

        Profile::create([
            'user_id' => $user->id,
            'first_name' => 'David',
            'surname' => 'Rondina',
            'sex' => 'Male',
            'birthdate' => '1999-01-01',
            'address' => 'Bacoor City, Cavite',
            'phone_no' => '09123456789',
        ]);

        $dept = Department::create(['name' => 'GAS']);

        $fac = Faculty::create([
            'user_id' => $user->id,
            'department_id' => $dept->id,
        ]);
    }
}
