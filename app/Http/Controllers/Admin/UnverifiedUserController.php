<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use App\Enums\RegisterStatus;
use App\Models\UnverifiedUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

        return view('users.admin.users.unverified.show', compact(['user']));
    }

    public function approve(string $id)
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

        $this->store($uv_user->lrn, $user, $profile, $guardian);

        $uv_user->update([
            'status' => RegisterStatus::VERIFIED->value
        ]);

        return to_route('admin.users.unverified.index')->with('success_message', 'Student & guardian info registered successfully.');
    }

    // TODO: Send email to student's email address
    private function store(string $lrn, array $user, array $profile, array $guardian)
    {
        $registered_user = User::create($user);

        $registered_guardian = Guardian::create($guardian);

        // Create profile related to registered user
        $profile['user_id'] = $registered_user->id;

        $user_profile = Profile::create($profile);

        // Create student record related to user
        $student_info = [
            'user_id' => $registered_user->id,
            'first_name' => $user_profile->first_name,
            'middle_name' => $user_profile->middle_name,
            'surname' => $user_profile->surname,
            'sex' => $user_profile->sex,
            'birthdate' => $user_profile->birthdate,
            'address' => $user_profile->address,
            'phone_no' => $user_profile->phone_no,
            'guardian_id' => $registered_guardian->id,
            'lrn' => $lrn,
        ];

        Student::create($student_info);
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
