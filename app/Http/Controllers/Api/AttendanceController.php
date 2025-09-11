<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendancePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * List semua attendance user yang login
     */
    public function index()
    {
        $user = Auth::user();

        $attendances = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Attendance history fetched successfully',
            'data'    => $attendances,
        ]);
    }


    /**
     * Show detail attendance tertentu
     */
    public function show(Attendance $attendance)
    {
        if ($attendance->user_id !== Auth::id()) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Attendance detail fetched successfully',
            'data'    => $attendance->load('point'),
        ]);
    }

    /**
     * Check-in ke titik absensi
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Jika request ada alasan, berarti ini izin
        if ($request->has('reason')) {
            $request->validate([
                'reason'     => 'required|string',
                'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            ]);

            // 🔎 Cek apakah sudah ada absensi hari ini
            $todayAttendance = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($todayAttendance) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Attendance already submitted for today',
                ], 422);
            }

            $path = null;
            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('attachments', 'public');
            }

            $attendance = Attendance::create([
                'user_id'    => $user->id,
                'type'       => 'permission',
                'reason'     => $request->reason,
                'attachment' => $path,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Permission submitted successfully',
                'data'    => $attendance,
            ], 201);
        }

        // 👉 Kalau tidak ada reason → berarti ini absensi hadir (present)
        $request->validate([
            'attendance_point_id' => 'required|exists:attendance_points,id',
            'latitude'            => 'required|numeric',
            'longitude'           => 'required|numeric',
        ]);

        $point = AttendancePoint::findOrFail($request->attendance_point_id);

        // 📍 Cek jarak
        $distance = $this->calculateDistance(
            $point->latitude,
            $point->longitude,
            $request->latitude,
            $request->longitude
        );

        if ($distance > $point->radius) {
            return response()->json([
                'status'  => false,
                'message' => 'You are outside the attendance area',
                'distance'=> $distance,
            ], 422);
        }

        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if (!$todayAttendance) {
            /// 👉 Check In
            $attendance = Attendance::create([
                'user_id'             => $user->id,
                'attendance_point_id' => $point->id,
                'type'                => 'present',
                'check_in_latitude'   => $request->latitude,
                'check_in_longitude'  => $request->longitude,
                'check_in_at'         => now(),
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Check-in recorded successfully',
                'data'    => $attendance,
            ], 201);
        }

        if ($todayAttendance->check_in_at && !$todayAttendance->check_out_at) {
            // 👉 Check Out
            $todayAttendance->update([
                'check_out_latitude'  => $request->latitude,
                'check_out_longitude' => $request->longitude,
                'check_out_at'        => now(),
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Check-out recorded successfully',
                'data'    => $todayAttendance,
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'You have already completed attendance for today',
        ], 422);
    }


    /**
     * Hitung jarak antara dua titik koordinat (meter)
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}
