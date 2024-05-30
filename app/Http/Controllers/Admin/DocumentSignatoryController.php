<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DocumentSignatory;
use App\Http\Controllers\Controller;

class DocumentSignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signatories = DocumentSignatory::latest()->get();

        return view('users.admin.signatory.index', compact(['signatories']));
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
        $sig = DocumentSignatory::findOrFail($id);

        return view('users.admin.signatory.edit', compact(['sig']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $request->file());

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'proof_image' => ['base64mimes:jpg,jpeg,png', 'base64max:5000']
        ]);

        $sig = DocumentSignatory::findOrFail($id);

        $new_signatory = [
            'name' => $request->name ?? $sig->name,
            'position' => $request->position ?? $sig->position,
        ];

        if ($request->hasFile('signature_image')) {
            // Remove current image from storage
            unlink(storage_path('app/public/' . $sig->signature_image));

            // Store new uploaded image in storage
            $image_name = 'IMG_' . uniqid() . '.' . $request->signature_image->extension();
            $path = $request->signature_image->storeAs('uploads/images/document-signatory', $image_name, 'public');
            $signature_image = $path;

            // Assign image path
            $sig['signature_image'] = $signature_image;
        }

        $sig->update($new_signatory);

        return back()->with('success_message', 'Recorded updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
