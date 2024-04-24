<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'report_id',
        'complaint_id',
        'start_date',
        'end_date',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
