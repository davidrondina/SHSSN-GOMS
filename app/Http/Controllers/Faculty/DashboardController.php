<?php

namespace App\Http\Controllers\Faculty;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $year = AcademicYear::where('is_current', true)->first();

        return view('users.faculty.dashboard', compact(['year']));
    }
}
