<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAllUser = User::count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        return view('pages.dashboard', compact('totalAllUser', 'totalStaff', 'totalDosen', 'totalMahasiswa'));
    }
}
