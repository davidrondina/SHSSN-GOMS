<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $appointments_coll = Appointment::get();

        $appointments = [];

        foreach ($appointments_coll as $app) {
            $events[] = [
                'url' => '/events/admin/' . (string) $app->id . '/edit',
                'title' => 'Complainant: {$app->complainant->profile->getFullName()}\nRespondent:{$app->respondent->studentInfo->getFullName()}',
                'start' => $app->start_time,
                'end' => $app->end_time,
            ];
        }

        return view('users.counselor.dashboard', compact(['appointments']));
    }
}
