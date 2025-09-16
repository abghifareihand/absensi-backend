<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Tampilkan semua kehadiran normal (present)
    public function presentIndex()
    {
        $attendances = Attendance::where('type', 'present')
            ->with('user')
            ->orderBy('check_in_at', 'desc')
            ->paginate(20);

        return view('pages.attendance.present.index', compact('attendances'));
    }

    // Tampilkan semua izin / permission
    public function permissionIndex()
    {
        $attendances = Attendance::where('type', 'permission')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.attendance.permission.index', compact('attendances'));
    }
}
