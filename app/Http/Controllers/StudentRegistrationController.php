<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnverifiedUser;
use App\Models\UnverifiedUserGuardian;

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
            'phone_no' => ['required', 'numeric', 'max_digits:11'],
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
        // dd($request->file(), $request->all());
        // dd($request->file('proof_image'), $request->proof_iamge, $request->input('proof_image'), $request->all());
        // dd($request->all());

        $student_fields = [
            'lrn' => $request->lrn,
            'email' => $request->student_email,
            'password' => $request->password,
            'first_name' => $request->student_first_name,
            'middle_name' => $request->student_middle_name ?? null,
            'surname' => $request->student_surname,
            'suffix' => $request->student_suffix ?? null,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'sex' => $request->sex,
            'phone_no' => $request->student_phone_no ?? null,
        ];

        if ($request->hasFile('proof_image')) {
            $image_name = 'IMG_' . uniqid() . '.' . $request->proof_image->extension();

            $path = $request->proof_image->storeAs('uploads/images/unverified-user', $image_name, 'public');

            $student_fields['proof_image'] = asset('/storage/' . $path);

            // $student_fields['proof_image'] = $request->file('proof_image')->store('uploads/images/unverified-user', 'public');
        }

        // dd($student_fields);

        $guardian_fields = [
            'first_name' => $request->guardian_first_name,
            'middle_name' => $request->guardian_middle_name ?? null,
            'surname' => $request->guardian_surname,
            'suffix' => $request->guardian_suffix ?? null,
            'birthdate' => $request->birthdate,
            'email' => $request->guardian_email,
            'phone_no' => $request->guardian_phone_no ?? null,
        ];

        $student = UnverifiedUser::create($student_fields);

        $guardian_fields['unverified_user_id'] = $student->id;

        $guardian = UnverifiedUserGuardian::create($guardian_fields);

        return to_route('student-register.success')->with('success_message', 'Submitted successfully! It will be reviewed by the admin.');
    }

    public function success()
    {
        return view('auth.register-success');
    }
}
