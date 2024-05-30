<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentSignatory extends Model
{
    use HasFactory;

    protected $fillable = [
        'signature_image',
        'name',
        'position',
        'type',
    ];
}
