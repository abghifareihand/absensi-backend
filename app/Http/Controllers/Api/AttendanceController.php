<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        // Validate latitude and longitude (required)
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Check if user has already checked in for today
        $existingAttendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        if ($existingAttendance) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'User has already check in for today',
            ], 400);
        }

        $attendance = Attendance::create([
            'user_id' => $request->user()->id,
            'date' => date('Y-m-d'),
            'time_in' => date('H:i:s'),
            'latlong_in' => $request->latitude . ',' . $request->longitude,
        ]);

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Check In success',
            'data' => $attendance,
        ]);
    }

    public function checkOut(Request $request)
    {
        // Validate latitude and longitude (required)
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Get today's attendance for the authenticated user
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        // Check if attendance record exists
        if (!$attendance) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'No attendance record found for today',
            ], 404);
        }

        // Update the attendance record with check-out details
        $attendance->update([
            'time_out' => date('H:i:s'),
            'latlong_out' => $request->latitude . ',' . $request->longitude,
        ]);

        // Return response
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Check Out success',
            'data' => $attendance,
        ]);
    }

    public function isCheckedin(Request $request)
    {
        $attendance  = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        return response()->json([
            'checkedin' => $attendance ? true : false,
        ]);
    }
}
