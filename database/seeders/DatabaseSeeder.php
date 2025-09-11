<?php

namespace Database\Seeders;

use App\Models\AttendancePoint;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat 2 user manual
        $andi = User::factory()->create([
            'name' => 'Andi Setiadi',
            'username' => 'andisetiadi',
            'email' => 'andisetiadi@gmail.com',
            'role' => 'mahasiswa',
            'password' => Hash::make('andi123'),
            'identity_number' => 'MHS101',
            'phone' => '081234567899',
            'address' => 'Jl. Bento No. 99',
        ]);

        $joko = User::factory()->create([
            'name' => 'Joko Sujatmiko',
            'username' => 'jokowi',
            'role' => 'mahasiswa',
            'password' => Hash::make('joko123'),
        ]);

        // jadwal untuk Andi (5 record)
        Schedule::factory()->count(5)->create([
            'user_id' => $andi->id,
        ]);

        // jadwal untuk Joko (3 record)
        Schedule::factory()->count(3)->create([
            'user_id' => $joko->id,
        ]);

        AttendancePoint::create([
            'name'   => 'DOS Padel Andara',
            'latitude' => -6.3247048,
            'longitude' => 106.8017465,
            'radius' => 1000,
        ]);

        AttendancePoint::create([
            'name'   => 'Ragunan Zoo',
            'latitude' => -6.3158541,
            'longitude' => 106.8127202,
            'radius' => 5000,
        ]);

        Setting::create([
            'key'   => 'home_title',
            'value' => 'Selamat Datang di Aplikasi Absensi Kampus 🎓',
        ]);

        Event::create([
            'title' => 'Grand Opening',
            'image' => 'https://visitingjogja.jogjaprov.go.id/wp-content/uploads/2023/11/sriharjo-3.jpg',
            'event_date' => now(),
        ]);

    }
}
