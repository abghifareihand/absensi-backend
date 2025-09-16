<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'attendance_point_id',
        'reason',
        'attachment',
        'check_in_latitude',
        'check_in_longitude',
        'check_out_latitude',
        'check_out_longitude',
        'check_in_at',
        'check_out_at',
        'start_date',
        'end_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendancePoint()
    {
        return $this->belongsTo(AttendancePoint::class);
    }
}
