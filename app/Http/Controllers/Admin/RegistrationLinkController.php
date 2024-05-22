<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RegistrationLink;
use App\Http\Controllers\Controller;

class RegistrationLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = RegistrationLink::where('is_used', false)->latest()->paginate(30)->withQueryString();

        return view('users.admin.registration-links.index', compact(['links']));
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
        $token = Str::random(32);
        $expiry_time = now()->addHours(48);
        $expiry_time = $expiry_time->format('Y-m-d H:i:s');

        $url = route('faculty-register.create') . '?token=' . $token;

        $link = RegistrationLink::create([
            'token' => $token,
            'url' => $url,
            'expires_at' => $expiry_time,
        ]);

        return to_route('admin.registration-links.show', $link->id)->with('success_message', 'Registration link has been generated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = RegistrationLink::findOrFail($id);

        return view('users.admin.registration-links.success', compact(['link']));
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
