<?php

namespace App\Http\Controllers\Counselor;

use Closure;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Mail\AppointmentNotice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments_coll = Appointment::get();

        $appointments = [];

        foreach ($appointments_coll as $app) {
            $appointments[] = [
                'url' => '/counselor/appointments/' . (string) $app->id,
                'title' => $app->complaint->respondent->getFullName(),
                // 'title' => Carbon::parse($app->start_date)->format('g:i A') . ' - ' . Carbon::parse($app->end_date)->format('g:i A'),
                'start' => $app->start_date,
                'end' => $app->end_date,
            ];
        }

        $appointment_obj = new Appointment();
        $upcoming_apps = $appointment_obj->upcomingAppointments()->get();

        // dd($appointments);

        return view('users.counselor.appointments.index', compact(['appointments', 'upcoming_apps']));
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
        // dd($request->all());

        $request->validate([
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date',
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $start_time = Carbon::parse($request->start_date)->format('H:i:s');
                    $end_time = Carbon::parse($request->end_date)->format('H:i:s');

                    if ($start_time > $end_time) {
                        $fail('The start time must be behind end time.');
                    }
                },
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $start_time = Carbon::parse($request->start_date)->format('H:i:s');
                    $end_time = Carbon::parse($request->end_date)->format('H:i:s');

                    if ($start_time === $end_time) {
                        dd($start_time === $end_time, $start_time, $end_time);
                        $fail('The start & end time must be different.');
                    }
                }
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $start_time = Carbon::parse($request->start_date)->format('H:i:s');
                    $end_time = Carbon::parse($request->end_date)->format('H:i:s');

                    if ($end_time < $start_time) {
                        $fail('The end time must be ahead of start time.');
                    }
                }
            ],
        ]);

        Appointment::create([
            'complaint_id' => $request->complaint_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return to_route('counselor.complaints.show', ['complaint' => $request->complaint_id])->with('success_message', 'Appointment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::find($id);
        $complaint = $appointment->complaint;
        $respondent = $complaint->respondent;
        $respondent_guardian = $respondent->guardian;

        return view('users.counselor.appointments.show', compact(['appointment', 'complaint', 'respondent', 'respondent_guardian']));
    }

    public function notify(Request $request)
    {
        $guardian = Guardian::findOrFail($request->guardian_id);
        $appointment = Appointment::findOrFail($request->appointment_id);
        $student = Student::findOrFail($request->student_id);

        // dd($guardian, $appointment, $student);

        Mail::to($guardian->email)->send(new AppointmentNotice($appointment, $guardian, $student));

        return back()->with('success_message', 'Email has been sent successfully');
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
