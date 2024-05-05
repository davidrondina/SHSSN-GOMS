<?php

namespace App\Actions;

use Illuminate\Support\Str;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SendUserFeedback
{
    public function handle(Request $request)
    {
        $user = Auth::user();

        return UserFeedback::create([
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    }
}
