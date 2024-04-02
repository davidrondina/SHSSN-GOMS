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
        'address',
        'phone_no',
        'proof_image',
        'status',
    ];

    public function getFullName()
    {
        return $this->surname .
            (($this->suffix) ? (' ' . $this->suffix . ', ') : ', ') .
            $this->first_name .
            (($this->middle_name) ? (' ' . substr($this->middle_name, 0, 1) . '.') : '')
        ;
    }

    public function guardian()
    {
        return $this->hasOne(UnverifiedUserGuardian::class);
    }
}
