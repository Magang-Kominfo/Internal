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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('no_agenda')->unique();
            $table->foreignId('id_sifat')->constrained(table: 'sifats', indexName: 'id_sifat'); // Foreign key
            $table->string('no_berita');
            $table->integer('jumlah_halaman_berita');
            $table->dateTime('tanggal_buat_berita');
            $table->longText('isi_berita');
            $table->string('dokumen_surat_berita')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
