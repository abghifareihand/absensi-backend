<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Tampilkan semua event
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        return view('pages.events.index', compact('events'));
    }

    // Form tambah event
    public function create()
    {
        return view('pages.events.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // wajib
        ], [
            'title.required' => 'Judul event wajib diisi!',
            'event_date.required' => 'Tanggal event wajib diisi!',
            'event_date.date' => 'Tanggal event tidak valid!',
            'event_time.required' => 'Jam event wajib diisi!',
            'image.required' => 'Image event wajib diisi!',
            'image.image' => 'File harus berupa image!',
            'image.mimes' => 'Format image harus jpg, jpeg, png, atau gif!',
            'image.max' => 'Ukuran image maksimal 2MB!',
        ]);


        $date = $request->input('event_date');
        $time = $request->input('event_time');
        $eventDateTime = \Carbon\Carbon::parse("$date $time");
        $now = \Carbon\Carbon::now();

        // Jika tanggal event hari ini tapi jamnya sudah lewat
        if ($eventDateTime->lt($now)) {
            if (\Carbon\Carbon::parse($date)->isToday()) {
                return back()->withErrors(['event_time' => 'Jam event harus di masa depan!'])
                            ->withInput();
            } else {
                return back()->withErrors(['event_date' => 'Tanggal event harus di masa depan!'])
                            ->withInput();
            }
        }

        $data = [
            'title' => $request->input('title'),
            'event_date' => $eventDateTime,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat!');
    }




    // Form edit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('pages.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'title.required' => 'Judul event wajib diisi!',
            'event_date.required' => 'Tanggal event wajib diisi!',
            'event_date.date' => 'Tanggal event tidak valid!',
            'event_time.required' => 'Jam event wajib diisi!',
            'image.image' => 'File harus berupa image!',
            'image.mimes' => 'Format image harus jpg, jpeg, png, atau gif!',
            'image.max' => 'Ukuran image maksimal 2MB!',
        ]);

        // Gabungkan tanggal + jam
        $date = $request->input('event_date');
        $time = $request->input('event_time');
        $eventDateTime = \Carbon\Carbon::parse("$date $time");
        $now = \Carbon\Carbon::now();

        // Validasi jika event di masa lalu
        if ($eventDateTime->lt($now)) {
            if (\Carbon\Carbon::parse($date)->isToday()) {
                return back()->withErrors(['event_time' => 'Jam event harus di masa depan!'])
                            ->withInput();
            } else {
                return back()->withErrors(['event_date' => 'Tanggal event harus di masa depan!'])
                            ->withInput();
            }
        }

        $data = [
            'title' => $request->input('title'),
            'event_date' => $eventDateTime,
        ];

        // Upload image baru jika ada
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }


    // Hapus event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }
}
