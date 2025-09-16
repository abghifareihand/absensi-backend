<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendancePoint;
use Illuminate\Http\Request;

class AttendancePointController extends Controller
{
    // List semua point
    public function index()
    {
        $points = AttendancePoint::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.points.index', compact('points'));
    }

    // Form buat point baru
    public function create()
    {
        return view('pages.points.create');
    }

    // Simpan point baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|integer|min:1',
        ]);

        AttendancePoint::create($request->only(['name', 'latitude', 'longitude', 'radius']));

        return redirect()->route('points.index')->with('success', 'Attendance point berhasil ditambahkan.');
    }

    // Form edit point
    public function edit($id)
    {
        $point = AttendancePoint::findOrFail($id);
        return view('pages.points.edit', compact('point'));
    }

    // Update point
    public function update(Request $request, $id)
    {
        $point = AttendancePoint::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'required|integer|min:1',
        ]);

        $point->update($request->only(['name', 'latitude', 'longitude', 'radius']));

        return redirect()->route('points.index')->with('success', 'Attendance point berhasil diperbarui.');
    }

    // Hapus point
    public function destroy($id)
    {
        $point = AttendancePoint::findOrFail($id);
        $point->delete();

        return redirect()->route('points.index')->with('success', 'Attendance point berhasil dihapus.');
    }
}
