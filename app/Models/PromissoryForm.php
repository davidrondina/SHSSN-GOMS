<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromissoryForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_link_id',
        'student_id',
        'section_id',
    ];
    
    public function documentLink()
    {
        return $this->belongsTo(DocumentLink::class);
    }
}
