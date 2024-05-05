<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Student;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // $complaints = Complaint::where([['faculty_user_id', $user->id], ['is_closed', false]])->latest()->paginate(30)->withQueryString();

        $complaints = $user->complaintsSubmitted();
        $complaints = $complaints->where('is_closed', false)->with(['complainant', 'respondent'])->latest()->paginate(30)->withQueryString();

        // dd($complaints);

        return view('users.faculty.complaints.index', compact(['user', 'complaints']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('surname')->get();

        return view('users.faculty.complaints.create', compact(['students']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'student' => ['required'],
            'reason' => ['required'],
            'other' => ['required_if:reason,Other', 'max:100'],
            'additional_info' => ['required'],
        ]);

        $user = Auth::user();

        $complaint_reason = null;

        if ($request->reason === 'Other') {
            $complaint_reason = $request->other;
        } else {
            $complaint_reason = $request->reason;
        }

        $complaint = Complaint::create([
            'faculty_user_id' => $user->id,
            'student_id' => $request->student[0],
            'reason' => $complaint_reason,
            'additional_info' => $request->additional_info
        ]);

        // dd($complaint);

        return to_route('faculty.complaints.index')->with('success_message', 'Complaint has been submitted');
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
