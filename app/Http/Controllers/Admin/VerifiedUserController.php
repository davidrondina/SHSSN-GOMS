<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifiedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Profile::whereHas('user', function ($query) {
            $query->role(['counselor', 'faculty', 'user'])->where('id', '>', 1);
        })->orderBy('surname')->paginate(30)->withQueryString();

        return view('users.admin.users.verified.index', compact(['users']));
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
