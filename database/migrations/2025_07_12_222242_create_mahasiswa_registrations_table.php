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
        Schema::create('mahasiswa_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('nama_lengkap');
            $table->text('alamat_ktp');
            $table->text('alamat_sekarang');
            $table->string('kecamatan');
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('provinsi_id');

            $table->string('telepon');
            $table->string('no_hp');
            $table->string('email');

            $table->enum('kewarganegaraan', ['WNI Asli', 'WNI Keturunan', 'WNA']);
            $table->string('kewarganegaraan_negara')->nullable();

            $table->string('tempat_lahir');
            $table->string('kota_lahir');
            $table->unsignedBigInteger('provinsi_lahir_id');
            $table->string('negara_lahir')->nullable();
            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->enum('status_menikah', ['Belum menikah', 'Menikah', 'Lain-lain']);
            $table->string('agama');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_registrations');
    }
};
