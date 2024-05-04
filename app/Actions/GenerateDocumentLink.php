<?php

namespace App\Actions;

use Illuminate\Support\Str;
use App\Models\DocumentLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GenerateDocumentLink
{
    public function handle(Request $request)
    {
        $user_id = Auth::user()->id;
        $token = Str::random(32);
        $type = $request->type;
        $expiry_time = now()->addHours(48);
        $expiry_time = $expiry_time->format('Y-m-d H:i:s');

        $url = route('download-file') . '?token=' . $token;

        // dd($request->all(), $user_id, $token, $expiry_time, $url);

        return DocumentLink::create([
            'user_id' => $user_id,
            'token' => $token,
            'url' => $url,
            'type' => $type,
            'expires_at' => $expiry_time,
        ]);
    }
}
