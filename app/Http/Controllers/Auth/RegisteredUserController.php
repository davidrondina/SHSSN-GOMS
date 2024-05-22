<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Faculty;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\RegistrationLink;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * This serves as registration for the faculty
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        // Get reg. link model that matches the reg. link token
        $link = RegistrationLink::where('token', $request->link_token)->first();

        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'], // Regex to accept only alpha chars and whitespaces
            'middle_name' => ['nullable', 'regex:/^[\pL\s]+$/u', 'max:60',],
            'surname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'],
            'address' => ['required', 'string', 'max:90'],
            'sex' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone_no' => ['required', 'numeric', 'max_digits:11'],
        ]);

        $user = User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $faculty = Faculty::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name ?? null,
            'surname' => $request->surname,
            'suffix' => $request->suffix ?? null,
            'sex' => $request->sex,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
        ]);

        $faculty_role = Role::where('name', UserRole::FA->value)->first();

        $user->assignRole($faculty_role);

        $link->update(['is_used' => true]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
