<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = null;

        if ($request->search) {
            $students = Student::where('surname', 'LIKE', '%' . $request->search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('lrn', 'LIKE', '%' . $request->search . '%')->orderBy('surname')->paginate(30)->withQueryString();
            // dd('onSearch', $students);
        } else {
            $students = Student::orderBy('surname')->paginate(30)->withQueryString();
            // dd('index', $students);
        }

        // dd($students);;

        return view('users.faculty.students.index', compact(['students']));
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
        $student = Student::find($id);

        return view('users.faculty.students.show', compact(['student']));
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
