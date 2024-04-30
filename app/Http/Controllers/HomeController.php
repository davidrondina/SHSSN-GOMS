<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    // Redirects user to their respective home page according their user role
    public function index()
    {
        $role = User::find(Auth::user()->id)->roles()->first();

        switch ($role->name) {
            case UserRole::AD->value:
                return to_route('admin.dashboard');
                break;
            case UserRole::CO->value;
                return to_route('counselor.dashboard');
                break;
            case UserRole::FA->value;
                return to_route('faculty.dashboard');
                break;
            default: // User role is student
                return to_route('student.dashboard');
                break;
        }
    }
}
