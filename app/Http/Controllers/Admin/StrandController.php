<?php

namespace App\Http\Controllers\Admin;

use App\Models\Strand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $strands = Strand::orderBy('name')->get();

        return view('users.admin.strands.index', compact(['strands']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admin.strands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:140'],
            'abbr' => ['required', 'string', 'max:50'],
        ]);

        Strand::create([
            'name' => $request->name,
            'abbr' => $request->abbr,
        ]);

        return to_route('admin.strands.index')->with('success_message', 'Strand has been added successfully');
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
        $strand = Strand::findOrFail($id);

        return view('users.admin.strands.edit', compact(['strand']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:140'],
            'abbr' => ['required', 'string', 'max:50'],
        ]);

        $strand = Strand::findOrFail($id);

        $strand->update([
            'name' => $request->name ?? $strand->name,
            'abbr' => $request->abbr ?? $strand->abbr
        ]);

        return back()->with('success_message', 'Strand info has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $strand = Strand::findOrFail($id);

        $strand->delete();

        return back()->with('success_message', 'Strand deleted successfully');
    }
}
