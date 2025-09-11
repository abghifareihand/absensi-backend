<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah semua user
        $totalAllUser = User::count();

        // Jumlah user dengan rola 'STAFF'
        $totalStaff = User::where('role', 'staff')->count();

        // Jumlah user dengan rola 'DOSEN'
        $totalDosen = User::where('role', 'dosen')->count();

        // Jumlah user dengan rola 'MAHASISWA'
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        return view('pages.dashboard', compact('totalAllUser', 'totalStaff', 'totalDosen', 'totalMahasiswa'));
    }
}
