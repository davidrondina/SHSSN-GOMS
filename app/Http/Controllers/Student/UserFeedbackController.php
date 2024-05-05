<?php

namespace App\Http\Controllers\Student;

use App\Actions\SendUserFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserFeedbackController extends Controller
{
    public function store(Request $request, SendUserFeedback $sendUserFeedback)
    {
        // dd($request->all());

        $request->validate([
            'rating' => 'required',
            'comment' => ['required', 'max: 255', 'string']
        ]);

        $feedback = $sendUserFeedback->handle($request);

        return to_route('document-guide.index', ['type' => $request->type, 'feedback' => true])->with('success_message', 'Feedback sent successfully.');
    }
}
