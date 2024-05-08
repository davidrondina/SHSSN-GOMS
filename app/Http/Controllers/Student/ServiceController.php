<?php

namespace App\Http\Controllers\Student;

use App\Mail\DocumentSent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GoodMoralForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Actions\GenerateDocumentLink;
use App\Providers\RouteServiceProvider;
use App\Enums\DocumentType;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.student.services.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->type) {
            $type = $request->type;
            $user = Auth::user();

            return view('users.student.services.create', compact(['type', 'user']));
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GenerateDocumentLink $generateDocumentLink)
    {
        // dd($request->all());

        $type = $request->type;

        $user_recipient = Auth::user();

        $document_link = $generateDocumentLink->handle($request);

        switch ($type) {
            case DocumentType::GM->value:
                GoodMoralForm::create([
                    'academic_year_id' => $request->academic_year,
                    'document_link_id' => $document_link->id,
                    'is_undergraduate' => $request->is_undergraduate,
                    'duration_as_student' => $request->duration,
                ]);
                break;
            default:
                # code...
                break;
        }

        // dd($document_link);

        Mail::to($user_recipient->email)->send(new DocumentSent($user_recipient, $document_link));

        return to_route('document-guide.index', ['type' => $type]);
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
