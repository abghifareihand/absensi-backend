<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ================= STAFF =================
    public function staffIndex()
    {
        $users = User::where('role', 'staff')->paginate(10);
        return view('pages.users.staff.index', compact('users'));
    }

    public function staffCreate()
    {
        return view('pages.users.staff.create');
    }

    public function staffStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'phone.required' => 'Nomor HP tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'staff',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.staff.index')->with('success', 'Staff created successfully');
    }

    public function staffEdit($id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);
        return view('pages.users.staff.edit', compact('user'));
    }

    public function staffUpdate(Request $request, $id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $data = $request->only(['name', 'username', 'identity_number', 'email', 'phone']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.staff.index')->with('success', 'Staff updated successfully');
    }

    public function staffDestroy($id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);
        $user->delete();

        return redirect()->route('users.staff.index')->with('success', 'Staff deleted successfully');
    }


    // ================= DOSEN =================
    public function dosenIndex()
    {
        $users = User::where('role', 'dosen')->paginate(10);
        return view('pages.users.dosen.index', compact('users'));
    }

    public function dosenCreate()
    {
        return view('pages.users.dosen.create');
    }

    public function dosenStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'phone.required' => 'Nomor HP tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'dosen',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.dosen.index')->with('success', 'Dosen created successfully');
    }

    public function dosenEdit($id)
    {
        $user = User::where('role', 'dosen')->findOrFail($id);
        return view('pages.users.dosen.edit', compact('user'));
    }

    public function dosenUpdate(Request $request, $id)
    {
        $user = User::where('role', 'dosen')->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $data = $request->only(['name', 'username', 'identity_number', 'email', 'phone']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.dosen.index')->with('success', 'Dosen updated successfully');
    }

    public function dosenDestroy($id)
    {
        $user = User::where('role', 'dosen')->findOrFail($id);
        $user->delete();

        return redirect()->route('users.dosen.index')->with('success', 'Dosen deleted successfully');
    }


    // ================= MAHASISWA =================
    public function mahasiswaIndex()
    {
        $users = User::where('role', 'mahasiswa')->paginate(10);
        return view('pages.users.mahasiswa.index', compact('users'));
    }

    public function mahasiswaCreate()
    {
        return view('pages.users.mahasiswa.create');
    }

    public function mahasiswaStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'phone.required' => 'Nomor HP tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'mahasiswa',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.mahasiswa.index')->with('success', 'Mahasiswa created successfully');
    }

    public function mahasiswaEdit($id)
    {
        $user = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('pages.users.mahasiswa.edit', compact('user'));
    }

    public function mahasiswaUpdate(Request $request, $id)
    {
        $user = User::where('role', 'mahasiswa')->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $data = $request->only(['name', 'username', 'identity_number', 'email', 'phone']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.mahasiswa.index')->with('success', 'Mahasiswa updated successfully');
    }

    public function mahasiswaDestroy($id)
    {
        $user = User::where('role', 'mahasiswa')->findOrFail($id);
        $user->delete();

        return redirect()->route('users.mahasiswa.index')->with('success', 'Mahasiswa deleted successfully');
    }
}
