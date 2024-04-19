<?php

namespace App\Http\Controllers\Admin;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = AcademicYear::where('is_current', true)->first();

        return view('users.admin.dashboard', compact(['year']));
    }
}
