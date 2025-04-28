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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id');
            $table->string('tgl_pengaduan');
            $table->string('unit_ruangan');
            $table->string('media');
            $table->string('masalah');
            $table->string('kategori');
            $table->text('isi_laporan');
            $table->string('foto');
            $table->string('solusi');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insertdata');
    }
};
