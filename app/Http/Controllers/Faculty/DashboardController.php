<?php

namespace App\Http\Controllers\Faculty;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user();
        $faculty = $auth_user->facultyInfo;
        $fac_subjects = $faculty->subjects;
        $year = AcademicYear::where('is_current', true)->first();

        $current_advisory = $faculty->advisorySections->where('academic_year_id', $year->id)->first();

        // dd($current_advisory, $auth_user, $faculty);

        return view('users.faculty.dashboard', compact(['current_advisory', 'faculty', 'fac_subjects', 'year']));
    }
}
