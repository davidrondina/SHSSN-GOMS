<?php

namespace Database\Factories;

use App\Enums\Sex;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Profile;
use App\Models\Guardian;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = $this->createUser();

        $guardian = $this->createGuardian();

        $student_info = [
            'user_id' => $user_id,
            'guardian_id' => $guardian->id,
            'lrn' => fake()->randomNumber(6, true) . fake()->randomNumber(6, true),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'surname' => fake()->lastName(),
            'sex' => fake()->randomElement(Sex::class),
            'address' => fake()->address(),
            'phone_no' => '09123456789',
        ];

        $this->createProfile($student_info);

        return $student_info;
    }

    private function createUser()
    {
        $user = User::create([
            'email' => fake()->email(),
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        $user_role = Role::where('name', UserRole::US->value)->first();

        $user->assignRole($user_role);

        return $user->id;
    }

    private function createGuardian()
    {
        $guardian = Guardian::create([
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'surname' => fake()->lastName(),
            'phone_no' => '09123456789',
            'email' => fake()->email(),
        ]);

        return $guardian;
    }

    private function createProfile(array $student_info)
    {
        Profile::create([
            'user_id' => $student_info['user_id'],
            'first_name' => $student_info['first_name'],
            'middle_name' => $student_info['first_name'],
            'surname' => $student_info['surname'],
            'sex' => $student_info['sex'],
            'address' => $student_info['address'],
            'phone_no' => $student_info['phone_no'],
        ]);
    }
}
