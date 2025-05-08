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
         // 1. Tabel Pengguna (admin, staff, customer)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Kata sandi
            $table->enum('role', ['admin', 'staff', 'customer'])->default('customer'); // Peran
            $table->string('phone')->nullable(); // Nomor telepon opsional
            $table->text('address')->nullable(); // Alamat opsional
            $table->rememberToken(); // Token untuk "remember me"
            $table->timestamps(); // created_at & updated_at
        });

         // 2. Tabel Tipe Kamar
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Suite, Deluxe
            $table->string('slug')->unique(); // URL slug unik
            $table->text('description'); // Deskripsi tipe kamar
            $table->decimal('base_price', 10, 2); // Harga dasar
            $table->integer('capacity'); // Kapasitas tamu
            $table->timestamps();
        });

         // 3. Tabel Kamar
         Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade'); // Relasi ke tipe kamar
            $table->string('room_number')->unique(); // Nomor kamar
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available'); // Status kamar
            $table->text('features')->nullable(); // Fitur kamar opsional
            $table->timestamps();
        });

           // 4. Tabel Reservasi
           Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke pengguna
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // Relasi ke kamar
            $table->date('check_in_date'); // Tanggal check-in
            $table->date('check_out_date'); // Tanggal check-out
            $table->integer('adults')->default(1); // Jumlah orang dewasa
            $table->integer('children')->default(0); // Jumlah anak-anak
            $table->decimal('total_price', 12, 2); // Total harga reservasi
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending'); // Status reservasi
            $table->text('special_requests')->nullable(); // Permintaan khusus
            $table->timestamps();
        });

        

    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_types');
        Schema::dropIfExists('users');
    }
};
