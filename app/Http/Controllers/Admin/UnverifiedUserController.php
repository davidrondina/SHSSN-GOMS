<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use App\Enums\RegisterStatus;
use App\Models\UnverifiedUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerificationSuccess;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class UnverifiedUserController extends Controller
{
    public function index(Request $request)
    {
        $users = UnverifiedUser::where('status', RegisterStatus::UNVERIFIED->value)->latest()->get();

        return view('users.admin.users.unverified.index', compact(['users']));
    }

    public function show(string $id)
    {
        $user = UnverifiedUser::find($id);
        $student_has_user = Student::where('lrn', $user->lrn)->has('user')->first();
        $user_has_lrn = Student::where('lrn', $user->lrn)->doesntHave('user')->first();

        return view('users.admin.users.unverified.show', compact(['user', 'student_has_user', 'user_has_lrn']));
    }

    public function approve(Request $request, string $id)
    {
        $uv_user = UnverifiedUser::find($id);
        $uv_guardian = $uv_user->guardian;

        // dd($uv_user, $uv_guardian);

        $user = [
            'email' => $uv_user->email,
            'password' => Hash::make($uv_user->password),
        ];

        $profile = [
            'first_name' => $uv_user->first_name,
            'middle_name' => $uv_user->middle_name,
            'surname' => $uv_user->surname,
            'suffix' => $uv_user->suffix,
            'sex' => $uv_user->sex,
            'birthdate' => $uv_user->birthdate,
            'address' => $uv_user->address,
            'phone_no' => $uv_user->phone_no,
        ];

        $guardian = [
            'first_name' => $uv_guardian->first_name,
            'middle_name' => $uv_guardian->middle_name,
            'surname' => $uv_guardian->surname,
            'suffix' => $uv_guardian->suffix,
            'email' => $uv_guardian->email,
            'phone_no' => $uv_guardian->phone_no,
        ];

        // dd($request->student_has_user ?? false, $request->student_has_user);

        $credentials = $this->store($uv_user->lrn, $user, $profile, $guardian, $request->student_has_user ?? false);

        $uv_user->update([
            'status' => RegisterStatus::VERIFIED->value
        ]);

        Mail::to($credentials['user']->email)->send(new UserVerificationSuccess($credentials['user'], $credentials['student']));

        return to_route('admin.users.unverified.index')->with('success_message', 'Student & guardian info registered successfully.');
    }

    // TODO: Send email to student's email address
    private function store(string $lrn, array $user, array $profile, array $guardian, $student_has_user = false)
    {
        $registered_user = User::create($user);

        $student_role = Role::where('name', UserRole::ST->value)->first();

        $registered_user->assignRole($student_role);

        // Create profile related to registered user
        $profile['user_id'] = $registered_user->id;

        $student = null;

        if ($student_has_user) { // If an existing lrn matches registered user's lrn, update every related models
            $student = Student::findOrFail($student_has_user);

            $student->update(['user_id' => $registered_user->id]);

            $profile['first_name'] = $student->first_name;
            $profile['middle_name'] = $student->middle_name ?? null;
            $profile['surname'] = $student->surname;

            $student_guardian = $student->guardian->update($guardian);
        } else { // Otherwise, create new models
            $registered_guardian = Guardian::create($guardian);

            $student_info = [
                'user_id' => $registered_user->id,
                'first_name' => $profile['first_name'],
                'middle_name' => $profile['middle_name'],
                'surname' => $profile['surname'],
                'sex' => $profile['sex'],
                'birthdate' => $profile['birthdate'],
                'address' => $profile['address'],
                'phone_no' => $profile['phone_no'],
                'guardian_id' => $registered_guardian->id,
                'lrn' => $lrn,
            ];

            $student = Student::create($student_info);
        }

        $user_profile = Profile::create($profile);

        $credentials = [
            'user' => $registered_user,
            'student' => $student,
        ];

        return $credentials;
    }

    // TODO: Before rejection, display popup modal stating the reason for rejection
    public function reject(string $id)
    {
        $user = UnverifiedUser::find($id);

        $user->delete();

        return to_route('admin.users.unverified.index')->with('success_message', 'Unverified student deleted successfully.');
    }

    public function destroy(string $id)
    {
        dd('Deleted');
        // $user = UnverifiedUser::find($id);

        // $user->delete();

        // return to_route('admin.users.unverified.index')->with('success_message', 'Unverified student deleted successfully.');
    }
}
