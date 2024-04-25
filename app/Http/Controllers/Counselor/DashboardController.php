<?php

namespace App\Http\Controllers\Counselor;

use Carbon\Carbon;
use App\Models\Complaint;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        // For total cases chart
        $prev_months = [];
        $month_names = [];

        /*
         * Get all the names of the previous 4 months
         * Where $i is the number of previous month (e.g. 3 means 4 previous months)
         */
        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonths($i);
            $month_name = $month->shortMonthName;
            $full_year = Carbon::today()->startOfMonth()->subMonths($i)->format('Y');

            array_push(
                $prev_months,
                array(
                    'month' => $month,
                    'year' => $full_year
                )
            );

            array_push($month_names, $month_name . '. ' . $full_year);
        }

        // Get all cases created over the past 4 months
        $cases = [];

        foreach ($prev_months as $month) {
            $complaints = Complaint::whereMonth('created_at', $month['month'])->whereYear('created_at', $month['year']);

            // if ($month['month']->shortMonthName == 'Apr') {
            //     dd($complaints, $month['month']);
            // }

            array_push($cases, $complaints->count());
        }

        // dd($cases);

        // Get all upcoming appointments
        $appointment_obj = new Appointment();
        $upcoming_apps = $appointment_obj->upcomingAppointments()->get();

        // Get total complaints/cases count
        $cases_count = Complaint::count();

        $weekly_apps = Appointment::whereBetween('start_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        return view('users.counselor.dashboard', compact(['appointments', 'appointments_coll', 'cases', 'cases_count', 'month_names', 'upcoming_apps', 'weekly_apps']));
    }
}
