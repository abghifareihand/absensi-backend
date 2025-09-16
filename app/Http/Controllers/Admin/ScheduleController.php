<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // ================= STAFF =================
    public function staffIndex()
    {
        $staff = User::where('role', 'staff')->paginate(10);
        return view('pages.schedules.staff.index', compact('staff'));
    }

    public function staffShow($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $schedules = $staff->schedules()
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('pages.schedules.staff.show', compact('staff', 'schedules'));
    }

    public function staffCreate($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('pages.schedules.staff.create', compact('staff'));
    }

    public function staffStore(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $staff->schedules()->create($data);

        return redirect()->route('schedules.staff.show', $staff->id)
                        ->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function staffEdit($id, $scheduleId)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $schedule = $staff->schedules()->findOrFail($scheduleId);

        return view('pages.schedules.staff.edit', compact('staff', 'schedule'));
    }

    public function staffUpdate(Request $request, $id, $scheduleId)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $schedule = $staff->schedules()->findOrFail($scheduleId);

        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        // Ambil hanya field yang diperlukan
        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $schedule->update($data);

        return redirect()->route('schedules.staff.show', $staff->id)
                        ->with('success', 'Jadwal berhasil diperbarui');
    }


    public function staffDestroy($id, $scheduleId)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $schedule = $staff->schedules()->findOrFail($scheduleId);

        $schedule->delete();

        return redirect()->route('schedules.staff.show', $staff->id)
                         ->with('success', 'Jadwal berhasil dihapus');
    }

    // ================= DOSEN =================
    public function dosenIndex()
    {
        $dosen = User::where('role', 'dosen')->paginate(10);
        return view('pages.schedules.dosen.index', compact('dosen'));
    }

    public function dosenShow($id)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $schedules = $dosen->schedules()
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('pages.schedules.dosen.show', compact('dosen', 'schedules'));
    }

    public function dosenCreate($id)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        return view('pages.schedules.dosen.create', compact('dosen'));
    }

    public function dosenStore(Request $request, $id)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $dosen->schedules()->create($data);

        return redirect()->route('schedules.dosen.show', $dosen->id)
                        ->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function dosenEdit($id, $scheduleId)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $schedule = $dosen->schedules()->findOrFail($scheduleId);

        return view('pages.schedules.dosen.edit', compact('dosen', 'schedule'));
    }

    public function dosenUpdate(Request $request, $id, $scheduleId)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $schedule = $dosen->schedules()->findOrFail($scheduleId);

        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        // Ambil hanya field yang diperlukan
        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $schedule->update($data);

        return redirect()->route('schedules.dosen.show', $dosen->id)
                        ->with('success', 'Jadwal berhasil diperbarui');
    }


    public function dosenDestroy($id, $scheduleId)
    {
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        $schedule = $dosen->schedules()->findOrFail($scheduleId);

        $schedule->delete();

        return redirect()->route('schedules.dosen.show', $dosen->id)
                         ->with('success', 'Jadwal berhasil dihapus');
    }


    // ================= MAHASISWA =================
    public function mahasiswaIndex()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->paginate(10);
        return view('pages.schedules.mahasiswa.index', compact('mahasiswa'));
    }

    public function mahasiswaShow($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $schedules = $mahasiswa->schedules()
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('pages.schedules.mahasiswa.show', compact('mahasiswa', 'schedules'));
    }

    public function mahasiswaCreate($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('pages.schedules.mahasiswa.create', compact('mahasiswa'));
    }

    public function mahasiswaStore(Request $request, $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $mahasiswa->schedules()->create($data);

        return redirect()->route('schedules.mahasiswa.show', $mahasiswa->id)
                        ->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function mahasiswaEdit($id, $scheduleId)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $schedule = $mahasiswa->schedules()->findOrFail($scheduleId);

        return view('pages.schedules.mahasiswa.edit', compact('mahasiswa', 'schedule'));
    }

    public function mahasiswaUpdate(Request $request, $id, $scheduleId)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $schedule = $mahasiswa->schedules()->findOrFail($scheduleId);

        $request->validate([
            'title' => 'required',
            'date' => ['required', 'date', function($attribute, $value, $fail) {
                $today = now()->startOfDay();
                $inputDate = \Carbon\Carbon::parse($value)->startOfDay();
                if ($inputDate->lt($today)) {
                    $fail('Tanggal harus hari ini atau setelahnya.');
                }
            }],
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', function($attribute, $value, $fail) use ($request) {
                $start = $request->input('start_time');
                if ($start && strtotime($value) <= strtotime($start)) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }],
            'location' => 'nullable|string|max:255',
        ]);

        // Ambil hanya field yang diperlukan
        $data = $request->only(['title', 'date', 'start_time', 'end_time', 'location']);
        $schedule->update($data);

        return redirect()->route('schedules.mahasiswa.show', $mahasiswa->id)
                        ->with('success', 'Jadwal berhasil diperbarui');
    }


    public function mahasiswaDestroy($id, $scheduleId)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $schedule = $mahasiswa->schedules()->findOrFail($scheduleId);

        $schedule->delete();

        return redirect()->route('schedules.mahasiswa.show', $mahasiswa->id)
                         ->with('success', 'Jadwal berhasil dihapus');
    }
}
