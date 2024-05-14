<?php

namespace App\Actions;

use Illuminate\Http\Request;
use App\Models\DocumentAcquisition;

class CreateAcquisitionRecord
{
    public function handle(Request $request, string $type, string $user_id)
    {
        return DocumentAcquisition::create([
            'user_id' => $user_id,
            'name' => $type,
        ]);
    }
}
