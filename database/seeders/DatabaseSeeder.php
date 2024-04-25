<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Bang Admin',
            'email' => 'admin@gmail.com',
            'phone' => '087777711022',
            'role' => 'ADMIN',
            'password' => Hash::make('admin123'),
        ]);

        User::factory()->create([
            'name' => 'Abghi Fareihan',
            'email' => 'abghi@gmail.com',
            'phone' => '087777711022',
            'role' => 'USER',
            'password' => Hash::make('abghi123'),
        ]);

        User::factory(10)->create();



        Company::create([
            'name' => 'PT. Goys Membangun Indonesia',
            'email' => 'info@goysgaming.com',
            'address' => 'Jalan Medan Merdeka',
            'latitude' => '-6.3298611',
            'longitude' => '106.8075094',
            'radius_km' => '3.5',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);

        Attendance::factory(10)->create();

    }
}
