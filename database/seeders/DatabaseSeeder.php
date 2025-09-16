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
        // Admin
        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'identity_number' => 'ADMIN99',
            'phone' => '0812345678',
            'address' => 'Jl. AdminAbsensi',
        ]);


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

        $wahyu = User::factory()->create([
            'name' => 'Wahyu Albusstomi',
            'username' => 'wahyu',
            'role' => 'staff',
            'password' => Hash::make('wahyu123'),
        ]);

        $joko = User::factory()->create([
            'name' => 'Joko Sujatmiko',
            'username' => 'jokowi',
            'role' => 'dosen',
            'password' => Hash::make('joko123'),
        ]);

        // jadwal untuk Andi (5 record)
        Schedule::factory()->count(15)->create([
            'user_id' => $andi->id,
        ]);

        // jadwal untuk Andi (5 record)
        Schedule::factory()->count(20)->create([
            'user_id' => $wahyu->id,
        ]);

        // jadwal untuk Joko (3 record)
        Schedule::factory()->count(10)->create([
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
