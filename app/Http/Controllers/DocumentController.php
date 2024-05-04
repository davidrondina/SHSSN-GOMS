<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\DocumentType;
use App\Models\DocumentLink;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $document = DocumentLink::where('token', $request->token)->first();
        $user = User::find($document->user_id);

        // dd($document, $user);

        $document->update(['is_used' => true]);

        switch ($document->type) {
            case DocumentType::GM->value:
                $pdf = Pdf::loadView('documents.good-moral', compact(['user']))->setOption('fontDir', storage_path('/fonts'));
                return $pdf->download('good-moral.pdf');
                break;
            default:
                # code...
                break;
        }
    }
}
