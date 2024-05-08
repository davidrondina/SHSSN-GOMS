<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\DocumentType;
use App\Models\DocumentLink;
use Illuminate\Http\Request;
use App\Models\GoodMoralForm;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $document = DocumentLink::where('token', $request->token)->first();
        $user = User::findOrFail($document->user_id);

        // dd($document, $user);

        $document->update(['is_used' => true]);

        switch ($document->type) {
            case DocumentType::GM->value:
                $good_moral =  GoodMoralForm::where('document_link_id', $document->id)->first();
                $pdf = Pdf::loadView('documents.good-moral', compact(['user', 'good_moral']))->setOption('fontDir', storage_path('/fonts'));
                return $pdf->download('good-moral.pdf');
                break;
            default:
                # code...
                break;
        }
    }
}
