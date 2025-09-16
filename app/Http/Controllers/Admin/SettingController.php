<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->paginate(10);
        return view('pages.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('pages.settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings,key|max:255',
            'value' => 'nullable|string',
        ]);

        Setting::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('settings.index')
                         ->with('success', 'Setting berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('pages.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
        ]);

        $setting->update([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('settings.index')
                         ->with('success', 'Setting berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect()->route('settings.index')
                         ->with('success', 'Setting berhasil dihapus.');
    }
}
