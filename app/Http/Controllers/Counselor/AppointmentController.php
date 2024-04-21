<?php

namespace App\Http\Controllers\Counselor;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $events[] = [
                'url' => '/events/admin/' . (string) $app->id . '/edit',
                'title' => 'Complainant: {$app->complainant->profile->getFullName()}\nRespondent:{$app->respondent->studentInfo->getFullName()}',
                'start' => $app->start_time,
                'end' => $app->end_time,
            ];
        }

        return view('users.counselor.appointments.index', compact(['appointments']));
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
        //
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
