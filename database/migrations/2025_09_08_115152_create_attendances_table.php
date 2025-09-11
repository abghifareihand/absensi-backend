<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Tipe absensi: hadir normal / izin
            $table->enum('type', ['present', 'permission'])->default('present');

            // Koordinat check-in
            $table->double('check_in_latitude')->nullable();
            $table->double('check_in_longitude')->nullable();

            // Koordinat check-out
            $table->double('check_out_latitude')->nullable();
            $table->double('check_out_longitude')->nullable();
            $table->foreignId('attendance_point_id')->nullable()->constrained()->onDelete('set null');

            // Untuk izin / cuti / sakit
            $table->string('reason')->nullable();
            $table->string('attachment')->nullable();

            // Waktu absensi
            $table->timestamp('check_in_at')->nullable();
            $table->timestamp('check_out_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
