<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Enums\DocumentType;
use App\Models\DocumentLink;
use Illuminate\Http\Request;
use App\Models\GoodMoralForm;
use App\Models\PromissoryForm;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Actions\CreateAcquisitionRecord;

class DocumentController extends Controller
{
    public function index(Request $request, CreateAcquisitionRecord $createAcquisitionRecord)
    {
        $document = DocumentLink::where('token', $request->token)->first();
        $user = User::findOrFail($document->user_id);

        // dd($document, $user);

        // $acquisition = $createAcquisitionRecord->handle($request, $document->type, $document->user_id);

        // $document->update(['is_used' => true]);

        switch ($document->type) {
            case DocumentType::GM->value:
                $good_moral = GoodMoralForm::where('document_link_id', $document->id)->first();
                $pdf = Pdf::loadView('documents.good-moral', compact(['user', 'good_moral']))->setOption('fontDir', storage_path('/fonts'));

                return $pdf->download('good-moral.pdf');
                break;

            case DocumentType::PN->value:
                $promissory_form = PromissoryForm::where('document_link_id', $document->id)->first();
                $student = Student::findOrFail($promissory_form->student_id);
                $section = null;

                if ($promissory_form->section_id) {
                    $section = Section::findOrFail($promissory_form->section_id);
                }

                // dd($promissory_form, $student, $section);
                $pdf = Pdf::loadView('documents.promissory-form', compact(['promissory_form', 'section', 'student']))->setOption('fontDir', storage_path('/fonts'));

                return $pdf->download('promissory-form.pdf');
                break;

            default:
                # code...
                break;
        }
    }
}
