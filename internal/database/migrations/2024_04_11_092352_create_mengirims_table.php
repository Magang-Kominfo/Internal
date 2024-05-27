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
        Schema::create('mengirims', function (Blueprint $table) {
            $table->foreignId('id_berita')->constrained(table: 'beritas', indexName: 'id_berita')
            ->onUpdate('cascade')->onDelete('cascade');; // Foreign key
            $table->foreignId('id_email')->constrained(table: 'emails', indexName: 'id_email')
            ->onUpdate('cascade')->onDelete('cascade');; // Foreign key
            $table->dateTime('tanggal_kirim_berita')->nullable();
            $table->dateTime('respon_time')->nullable();
            $table->boolean('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengirims');
    }
};
