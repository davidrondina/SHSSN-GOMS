<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function upcomingAppointments()
    {
        return $this->whereDate('start_date', '>=', Carbon::today());
    }
}
