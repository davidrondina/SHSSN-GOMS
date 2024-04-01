<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn',
        'email',
        'password',
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'birthdate',
        'sex',
        'phone_no',
        'proof_image',
        'status'
    ];

    public function unverifiedUserGuardian()
    {
        return $this->hasOne(UnverifiedUserGuardian::class);
    }
}
