<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendancePoint;
use Illuminate\Http\Request;

class AttendancePointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = AttendancePoint::all();

        return response()->json([
            'status'  => true,
            'message' => 'Attendance points fetched successfully',
            'data'    => $points,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendancePoint $attendancePoint)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Attendance point detail fetched successfully',
            'data'    => $attendancePoint,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
