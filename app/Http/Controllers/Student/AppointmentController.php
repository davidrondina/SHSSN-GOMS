<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // dd($user->studentInfo->id);

        $appointments_coll = Appointment::whereHas(
            'complaint',
            function ($query) use ($user) {
                $query->where('student_id', $user->studentInfo->id);
            }
        );

        // dd($appointments_coll->get());

        $appointments = [];

        foreach ($appointments_coll->get() as $app) {
            $appointments[] = [
                'url' => '/counselor/appointments/' . (string) $app->id,
                'title' => $app->complaint->respondent->getFullName(),
                'start' => $app->start_date,
                'end' => $app->end_date,
            ];
        }

        $upcoming_apps = $appointments_coll->whereDate('start_date', '>=', Carbon::now())->get();

        // dd($appointments_coll->get(), $upcoming_apps);

        return view('users.student.appointments.index', compact(['appointments', 'upcoming_apps']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $complaint = $appointment->complaint;
        $respondent = $complaint->respondent;
        $respondent_guardian = $respondent->guardian;

        return view('users.student.appointments.show', compact(['appointment', 'complaint', 'respondent', 'respondent_guardian']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
