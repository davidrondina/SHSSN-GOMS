<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnverifiedUser;

class StudentRegistrationController extends Controller
{
    public function verifyAccount(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email', 'max:60'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        return response(['message' => 'Account validation success'], 200);
    }

    public function verifyStudentInfo(Request $request)
    {
        $request->validate([
            'lrn' => ['required', 'integer', 'numeric', 'max_digits:12', 'unique:students,lrn'],
            'first_name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'], // Regex to accept only alpha chars and whitespaces
            'middle_name' => ['nullable', 'regex:/^[\pL\s]+$/u', 'max:60',],
            'surname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'],
            'address' => ['required', 'string', 'max:90'],
            'sex' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone_no' => ['numeric', 'sometimes', 'max_digits:11'],
            'proof_image' => ['required', 'base64mimes:jpg,jpeg,png', 'base64max:5000']
        ]);

        return response(['message' => 'Student validation success'], 200);
    }

    public function verifyGuardianInfo(Request $request)
    {
        $request->validate([
            'email' => ['nullable', 'email', 'max:60'],
            'first_name' => ['required', 'regex:/^[\pL\s]+$/u'],
            'middle_name' => ['nullable', 'regex:/^[\pL\s]+$/u', 'max:60'],
            'surname' => ['required', 'regex:/^[\pL\s]+$/u'],
            'phone_no' => ['required', 'numeric', 'max_digits:11'],
        ]);

        return response(['message' => 'Guardian validation success'], 200);
    }

    public function store(Request $request)
    {
        dd($request->all());

        // $uu_fields = [
        //     'lrn' => $request->lrn,
        //     'email' => $request->student_email,
        //     'first_name' => $request->first_name,
        //     'middle_name' => $request->middle_name ?? null,
        //     'surname' => $request->surname,
        //     'suffix' => $request->student_suffix ?? null,
        //     'birthdate' => $request->birthdate,
        //     'sex' => $request->sex,
        //     'phone_no' => $request->student_phone_no ?? null,
        // ];

        // $ug_fields = [
        //     'first_name' => $request->guardian_first_name,
        //     'middle_name' => $request->guardian_middle_name ?? null,
        //     'surname' => $request->guardian_surname,
        //     'suffix' => $request->guardian_suffix ?? null,
        //     'birthdate' => $request->birthdate,
        //     'sex' => $request->sex,
        //     'email' => $request->guardian_email,
        //     'phone_no' => $request->guardian_phone_no ?? null,
        // ];

    }
}
