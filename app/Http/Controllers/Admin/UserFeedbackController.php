<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserFeedback;
use Illuminate\Http\Request;

class UserFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        switch ($request->rating) {
            case 4:
                $feedback = UserFeedback::where('rating', 4)->latest()->paginate(30)->withQueryString();
                break;
            case 3:
                $feedback = UserFeedback::where('rating', 3)->latest()->paginate(30)->withQueryString();
                break;
            case 2:
                $feedback = UserFeedback::where('rating', 2)->latest()->paginate(30)->withQueryString();
                break;
            case 1:
                $feedback = UserFeedback::where('rating', 1)->latest()->paginate(30)->withQueryString();
                break;
            default:
                $feedback = UserFeedback::where('rating', 5)->latest()->paginate(30)->withQueryString();
                break;
        }

        return view('users.admin.feedback.index', compact(['feedback']));
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
