<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn',
        'student_email',
        'student_first_name',
        'student_middle_name',
        'student_surname',
        'student_suffix',
        'student_birthdate',
        'student_sex',
        'guardian_first_name',
        'guardian_middle_name',
        'guardian_surname',
        'guardian_suffix',
        'guardian_sex',
        'guardian_email',
        'guardian_contact_no',
        'proof_image',
        'status'
    ];
}
