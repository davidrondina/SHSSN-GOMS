<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\RegistrationLink;
use App\Providers\RouteServiceProvider;

class FacultyRegistrationController extends Controller
{
    public function create(Request $request)
    {
        $link = RegistrationLink::where('token', $request->token)->first();

        if (!$link) {
            return redirect()->intended(RouteServiceProvider::HOME)->with('error_message', 'The link is already expired or used.');
        }

        $departments = Department::get();

        return view('auth.faculty-register', compact(['departments']));
    }
}
