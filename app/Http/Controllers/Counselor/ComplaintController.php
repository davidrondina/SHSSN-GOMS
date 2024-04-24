<?php

namespace App\Http\Controllers\Counselor;

use App\Models\Faculty;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::where('is_closed', false)->latest()->paginate(30)->withQueryString();

        return view('users.counselor.complaints.index', compact(['complaints']));
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
        $complaint = Complaint::find($id);
        $complainant = $complaint->complainant;
        $respondent = $complaint->respondent;

        // dd($complainant, $complaint->complainant->user, $complainant_profile);

        return view('users.counselor.complaints.show', compact(['complaint', 'complainant', 'respondent']));
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
