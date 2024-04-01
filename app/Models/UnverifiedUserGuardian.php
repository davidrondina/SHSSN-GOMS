<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedUserGuardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'unverified_user_id',
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'email',
        'phone_no',
    ];

    public function unverifiedUser()
    {
        return $this->belongsTo(UnverifiedUser::class);
    }
}
