<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Models\DocumentGuide;
use Illuminate\Support\Facades\Auth;

class DocumentGuideController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $guide = DocumentGuide::where('name', $type)->first();

        $role = User::find(Auth::user()->id)->roles()->first();

        switch ($role->name) {
            case UserRole::AD->value:
                $document_guides = DocumentGuide::all();
                return view('users.admin.document-guides.index', compact(['document_guides']));
                break;
            case UserRole::FA->value;
                // dd('faculty view');
                return view('users.faculty.document-guides.index', compact(['guide', 'type']));
                break;
            case UserRole::ST->value: // User role is student
                // dd('student view');
                return view('users.student.document-guides.index', compact(['guide', 'type']));
                break;
        }

        // return view('document-guides.index', compact(['type']));
    }
}
