<?php

namespace App\Http\Controllers\Faculty;

use App\Mail\DocumentSent;
use App\Enums\DocumentType;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\PromissoryForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Actions\GenerateDocumentLink;
use App\Providers\RouteServiceProvider;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.faculty.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->type) {
            $type = $request->type;
            $user = Auth::user();

            return view('users.faculty.services.create', compact(['type', 'user']));
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GenerateDocumentLink $generateDocumentLink)
    {
        // dd($request->all(), $request->student[0]);

        $type = $request->type;

        $user_recipient = Auth::user();

        $document_link = null;

        switch ($type) {
            case DocumentType::PN->value:
                $request->validate([
                    'student' => 'required',
                ]);

                $student = Student::findOrFail($request->student[0]);

                // dd($student, $student->getCurrentSection()?->section, $student->getCurrentSection()?->section->id);

                $document_link = $generateDocumentLink->handle($request);

                PromissoryForm::create([
                    'document_link_id' => $document_link->id,
                    'student_id' => $student->id,
                    'section_id' => $student->getCurrentSection()->section->id ?? null,
                ]);
                break;
            default:
                # code...
                break;
        }

        // dd($document_link);

        Mail::to($user_recipient->email)->send(new DocumentSent($user_recipient, $document_link));

        return to_route('document-guide.index', ['type' => $type])->with('success_message', 'Document request successful');
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
