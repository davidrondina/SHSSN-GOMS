<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Profile;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\EnrolledStudent;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\FacultySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        AcademicYear::create([
            'start' => 2024,
            'end' => 2025,
            'is_current' => true
        ]);

        $user_roles = UserRole::cases();

        collect($user_roles)->map(function ($role) {
            Role::create([
                'name' => $role->value
            ]);
        });

        // Create admin user & profile
        $admin_user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('1234'),
        ]);

        $admin_role = Role::where('name', UserRole::AD->value)->first();

        $admin_user->assignRole($admin_role);

        Profile::create([
            'user_id' => $admin_user->id,
            'first_name' => 'Admin',
            'surname' => 'User',
            'sex' => 'Male',
            'phone_no' => '09123456789',
            'birthdate' => '1999-01-01',
            'address' => 'Bacoor City, Cavite',
        ]);

        $this->call([FacultySeeder::class]);

        // Enroll students to current AY
        $enrolled_students = Student::factory(10)->create();

        collect($enrolled_students)->map(function ($stu) {
            $year = AcademicYear::where('is_current', true)->first();

            EnrolledStudent::create([
                'student_id' => $stu->id,
                'academic_year_id' => $year->id,
                'grade_level' => 11,
            ]);
        });
    }
}
