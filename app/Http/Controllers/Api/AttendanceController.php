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
    // public function store(Request $request)
    // {
    //     $user = Auth::user();

    //     // Jika request ada alasan, berarti ini izin
    //     if ($request->has('reason')) {
    //         $request->validate([
    //             'reason'     => 'required|string',
    //             'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    //         ]);

    //         // 🔎 Cek apakah sudah ada absensi hari ini
    //         $todayAttendance = Attendance::where('user_id', $user->id)
    //             ->whereDate('created_at', now()->toDateString())
    //             ->first();

    //         if ($todayAttendance) {
    //             return response()->json([
    //                 'status'  => false,
    //                 'message' => 'Attendance already submitted for today',
    //             ], 422);
    //         }

    //         $path = null;
    //         if ($request->hasFile('attachment')) {
    //             $path = $request->file('attachment')->store('attachments', 'public');
    //         }

    //         $attendance = Attendance::create([
    //             'user_id'    => $user->id,
    //             'type'       => 'permission',
    //             'reason'     => $request->reason,
    //             'attachment' => $path,
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Permission submitted successfully',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     // 👉 Kalau tidak ada reason → berarti ini absensi hadir (present)
    //     $request->validate([
    //         'attendance_point_id' => 'required|exists:attendance_points,id',
    //         'latitude'            => 'required|numeric',
    //         'longitude'           => 'required|numeric',
    //     ]);

    //     $point = AttendancePoint::findOrFail($request->attendance_point_id);

    //     // 📍 Cek jarak
    //     $distance = $this->calculateDistance(
    //         $point->latitude,
    //         $point->longitude,
    //         $request->latitude,
    //         $request->longitude
    //     );

    //     if ($distance > $point->radius) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'You are outside the attendance area',
    //             'distance'=> $distance,
    //         ], 422);
    //     }

    //     $todayAttendance = Attendance::where('user_id', $user->id)
    //         ->whereDate('created_at', now()->toDateString())
    //         ->first();

    //     if (!$todayAttendance) {
    //         /// 👉 Check In
    //         $attendance = Attendance::create([
    //             'user_id'             => $user->id,
    //             'attendance_point_id' => $point->id,
    //             'type'                => 'present',
    //             'check_in_latitude'   => $request->latitude,
    //             'check_in_longitude'  => $request->longitude,
    //             'check_in_at'         => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Check-in recorded successfully',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     if ($todayAttendance->check_in_at && !$todayAttendance->check_out_at) {
    //         // 👉 Check Out
    //         $todayAttendance->update([
    //             'check_out_latitude'  => $request->latitude,
    //             'check_out_longitude' => $request->longitude,
    //             'check_out_at'        => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Check-out recorded successfully',
    //             'data'    => $todayAttendance,
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status'  => false,
    //         'message' => 'You have already completed attendance for today',
    //     ], 422);
    // }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();

    //     // Jika request ada reason → ini izin
    //     if ($request->has('reason')) {
    //         $request->validate([
    //             'reason'     => 'required|string',
    //             'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    //             'start_date' => 'required|date',
    //             'end_date'   => 'required|date|after_or_equal:start_date',
    //         ]);

    //         $path = null;
    //         if ($request->hasFile('attachment')) {
    //             $path = $request->file('attachment')->store('attachments', 'public');
    //         }

    //         $attendance = Attendance::create([
    //             'user_id'    => $user->id,
    //             'type'       => 'permission',
    //             'reason'     => $request->reason,
    //             'attachment' => $path,
    //             'start_date' => $request->start_date,
    //             'end_date'   => $request->end_date,
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Permission submitted successfully',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     // Present (check-in / check-out)
    //     $request->validate([
    //         'attendance_point_id' => 'required|exists:attendance_points,id',
    //         'latitude'            => 'required|numeric',
    //         'longitude'           => 'required|numeric',
    //     ]);

    //     $point = AttendancePoint::findOrFail($request->attendance_point_id);

    //     $distance = $this->calculateDistance(
    //         $point->latitude,
    //         $point->longitude,
    //         $request->latitude,
    //         $request->longitude
    //     );

    //     if ($distance > $point->radius) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'You are outside the attendance area',
    //             'distance'=> $distance,
    //         ], 422);
    //     }

    //     $todayAttendance = Attendance::where('user_id', $user->id)
    //         ->where('type', 'present')
    //         ->whereDate('created_at', now()->toDateString())
    //         ->first();

    //     if (!$todayAttendance) {
    //         // Check-in
    //         $attendance = Attendance::create([
    //             'user_id'             => $user->id,
    //             'attendance_point_id' => $point->id,
    //             'type'                => 'present',
    //             'check_in_latitude'   => $request->latitude,
    //             'check_in_longitude'  => $request->longitude,
    //             'check_in_at'         => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Check-in recorded successfully',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     if ($todayAttendance->check_in_at && !$todayAttendance->check_out_at) {
    //         // Check-out
    //         $todayAttendance->update([
    //             'check_out_latitude'  => $request->latitude,
    //             'check_out_longitude' => $request->longitude,
    //             'check_out_at'        => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Check-out recorded successfully',
    //             'data'    => $todayAttendance,
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status'  => false,
    //         'message' => 'You have already completed attendance for today',
    //     ], 422);
    // }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();
    //     $today = now()->toDateString();

    //     // Jika request ada reason → ini izin
    //     if ($request->has('reason')) {
    //         $request->validate([
    //             'reason'     => 'required|string',
    //             'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    //             'start_date' => 'required|date',
    //             'end_date'   => 'required|date|after_or_equal:start_date',
    //         ], [
    //             'reason.required' => 'Alasan izin wajib diisi',
    //             'start_date.required' => 'Tanggal mulai wajib diisi',
    //             'end_date.required' => 'Tanggal selesai wajib diisi',
    //             'end_date.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
    //             'attachment.mimes' => 'File harus berupa jpg, png, atau pdf',
    //             'attachment.max' => 'Ukuran file maksimal 2MB',
    //         ]);

    //         // Upload attachment jika ada
    //         $path = null;
    //         if ($request->hasFile('attachment')) {
    //             $path = $request->file('attachment')->store('attachments', 'public');
    //         }

    //         $attendance = Attendance::create([
    //             'user_id'    => $user->id,
    //             'type'       => 'permission',
    //             'reason'     => $request->reason,
    //             'attachment' => $path,
    //             'start_date' => $request->start_date,
    //             'end_date'   => $request->end_date,
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Izin berhasil diajukan',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     // Present (check-in / check-out)
    //     $request->validate([
    //         'attendance_point_id' => 'required|exists:attendance_points,id',
    //         'latitude'            => 'required|numeric',
    //         'longitude'           => 'required|numeric',
    //     ], [
    //         'attendance_point_id.required' => 'Titik absensi wajib dipilih',
    //         'latitude.required' => 'Latitude wajib diisi',
    //         'longitude.required' => 'Longitude wajib diisi',
    //     ]);

    //     // Cek apakah user sedang izin hari ini
    //     $activePermission = Attendance::where('user_id', $user->id)
    //         ->where('type', 'permission')
    //         ->whereDate('start_date', '<=', $today)
    //         ->whereDate('end_date', '>=', $today)
    //         ->first();

    //     if ($activePermission) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Anda sedang izin hari ini, tidak bisa melakukan absensi',
    //         ], 422);
    //     }

    //     $point = AttendancePoint::findOrFail($request->attendance_point_id);

    //     // Hitung jarak user ke titik absensi
    //     $distance = $this->calculateDistance(
    //         $point->latitude,
    //         $point->longitude,
    //         $request->latitude,
    //         $request->longitude
    //     );

    //     if ($distance > $point->radius) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Anda berada di luar area absensi',
    //             'distance'=> $distance,
    //         ], 422);
    //     }

    //     $todayAttendance = Attendance::where('user_id', $user->id)
    //         ->where('type', 'present')
    //         ->whereDate('created_at', $today)
    //         ->first();

    //     if (!$todayAttendance) {
    //         // Check-in
    //         $attendance = Attendance::create([
    //             'user_id'             => $user->id,
    //             'attendance_point_id' => $point->id,
    //             'type'                => 'present',
    //             'check_in_latitude'   => $request->latitude,
    //             'check_in_longitude'  => $request->longitude,
    //             'check_in_at'         => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Absensi masuk berhasil dicatat',
    //             'data'    => $attendance,
    //         ], 201);
    //     }

    //     if ($todayAttendance->check_in_at && !$todayAttendance->check_out_at) {
    //         // Check-out
    //         $todayAttendance->update([
    //             'check_out_latitude'  => $request->latitude,
    //             'check_out_longitude' => $request->longitude,
    //             'check_out_at'        => now(),
    //         ]);

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'Absensi pulang berhasil dicatat',
    //             'data'    => $todayAttendance,
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status'  => false,
    //         'message' => 'Anda sudah melakukan absensi hari ini',
    //     ], 422);
    // }

    public function store(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();

        // Jika request ada reason → ini izin
        if ($request->has('reason')) {
            $request->validate([
                'reason'     => 'required|string',
                'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
            ], [
                'reason.required' => 'Alasan izin wajib diisi',
                'start_date.required' => 'Tanggal mulai wajib diisi',
                'end_date.required' => 'Tanggal selesai wajib diisi',
                'end_date.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
                'attachment.mimes' => 'File harus berupa jpg, png, atau pdf',
                'attachment.max' => 'Ukuran file maksimal 2MB',
            ]);

            // 🔎 Cek konflik dengan absensi present
            $conflictPresent = Attendance::where('user_id', $user->id)
                ->where('type', 'present')
                ->where(function($q) use ($request) {
                    $q->whereDate('check_in_at', '>=', $request->start_date)
                    ->whereDate('check_in_at', '<=', $request->end_date);
                })
                ->exists();

            if ($conflictPresent) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda sudah melakukan absensi pada tanggal yang diajukan untuk izin',
                ], 422);
            }

            // 🔎 Cek apakah sudah ada izin di range ini
            $conflictPermission = Attendance::where('user_id', $user->id)
                ->where('type', 'permission')
                ->where(function($q) use ($request) {
                    $q->whereDate('start_date', '<=', $request->end_date)
                    ->whereDate('end_date', '>=', $request->start_date);
                })
                ->exists();

            if ($conflictPermission) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda sudah memiliki izin yang tumpang tindih dengan tanggal ini',
                ], 422);
            }

            // Upload attachment jika ada
            $path = null;
            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('attachments', 'public');
            }

            $attendance = Attendance::create([
                'user_id'    => $user->id,
                'type'       => 'permission',
                'reason'     => $request->reason,
                'attachment' => $path,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Izin berhasil diajukan',
                'data'    => $attendance,
            ], 201);
        }

        // Present (check-in / check-out)
        $request->validate([
            'attendance_point_id' => 'required|exists:attendance_points,id',
            'latitude'            => 'required|numeric',
            'longitude'           => 'required|numeric',
        ], [
            'attendance_point_id.required' => 'Titik absensi wajib dipilih',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        // Cek apakah user sedang izin hari ini
        $activePermission = Attendance::where('user_id', $user->id)
            ->where('type', 'permission')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        if ($activePermission) {
            return response()->json([
                'status'  => false,
                'message' => 'Anda sedang izin hari ini, tidak bisa melakukan absensi',
            ], 422);
        }

        $point = AttendancePoint::findOrFail($request->attendance_point_id);

        // Hitung jarak user ke titik absensi
        $distance = $this->calculateDistance(
            $point->latitude,
            $point->longitude,
            $request->latitude,
            $request->longitude
        );

        if ($distance > $point->radius) {
            return response()->json([
                'status'  => false,
                'message' => 'Anda berada di luar area absensi',
                'distance'=> $distance,
            ], 422);
        }

        $todayAttendance = Attendance::where('user_id', $user->id)
            ->where('type', 'present')
            ->whereDate('created_at', $today)
            ->first();

        if (!$todayAttendance) {
            // Check-in
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
                'message' => 'Absensi masuk berhasil dicatat',
                'data'    => $attendance,
            ], 201);
        }

        if ($todayAttendance->check_in_at && !$todayAttendance->check_out_at) {
            // Check-out
            $todayAttendance->update([
                'check_out_latitude'  => $request->latitude,
                'check_out_longitude' => $request->longitude,
                'check_out_at'        => now(),
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Absensi pulang berhasil dicatat',
                'data'    => $todayAttendance,
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Anda sudah melakukan absensi hari ini',
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


    public function checkAvailability()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        // Cek apakah ada izin aktif hari ini
        $activePermission = Attendance::where('user_id', $user->id)
            ->where('type', 'permission')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->exists();

        // Cek apakah sudah check-in hari ini
        $alreadyCheckedIn = Attendance::where('user_id', $user->id)
            ->where('type', 'present')
            ->whereDate('created_at', $today)
            ->exists();

        return response()->json([
            'status' => true,
            'can_check_in' => !$activePermission && !$alreadyCheckedIn,
            'can_request_permission' => !$activePermission && !$alreadyCheckedIn,
        ]);
    }

}
