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
    public function index()
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
            'name' => ['required', 'string', 'regex:/^[\s\w-]*$/', 'max:140'],
        ]);

        Strand::create([
            'name' => $request->name,
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
        $strand = Strand::find($id);

        return view('users.admin.strands.edit', compact(['strand']));
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
