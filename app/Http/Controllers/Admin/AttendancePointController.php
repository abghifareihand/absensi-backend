<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendancePoint;
use Illuminate\Http\Request;

class AttendancePointController extends Controller
{
    public function index()
    {
        $points = AttendancePoint::paginate(10);
        return view('pages.points.index', compact('points'));
    }

    public function create()
    {
        return view('pages.points.create');
    }
}
