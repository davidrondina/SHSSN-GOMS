<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodMoralForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'document_link_id',
        'is_undergraduate',
        'duration_as_student',
        'is_duration_month',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function documentLink()
    {
        return $this->belongsTo(DocumentLink::class);
    }
}
