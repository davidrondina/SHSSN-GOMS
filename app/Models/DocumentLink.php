<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'url',
        'type',
        'is_used',
        'expires_at',
    ];

    public function goodMoralForm()
    {
        return $this->hasOne(GoodMoralForm::class);
    }

    public function promissoryForm()
    {
        return $this->hasOne(PromissoryForm::class);
    }
}
