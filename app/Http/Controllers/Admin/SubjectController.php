<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subjects = Subject::orderBy('name')->paginate(30)->withQueryString();

        if ($request->search) {
            // dd($request->search);
            $subjects = Subject::where('name', 'like', '%' . $request->search . '%')->paginate(30)->withQueryString();
        }

        return view('users.admin.subjects.index', compact(['subjects']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[\s\w-]*$/', 'max:140'],
        ]);

        Subject::create([
            'name' => $request->name,
        ]);

        return to_route('admin.subjects.index')->with('success_message', 'Subject has been added successfully');
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
        $sub = Subject::findOrFail($id);

        return view('users.admin.subjects.edit', compact(['sub']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sub = Subject::findOrFail($id);

        $sub->update(['name' => $request->name ?? $sub->name]);

        return back()->with('success_message', 'Subject info has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub = Subject::findOrFail($id);

        $sub->delete();

        return back()->with('success_message', 'Subject deleted successfully');
    }
}
