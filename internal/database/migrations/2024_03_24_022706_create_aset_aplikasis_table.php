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
        Schema::create('aset_aplikasis', function (Blueprint $table) {
            $table->id('id_aset_aplikasi');
            ## $table->unsignedBigInteger('aa_id_jenis_kategori_foreign')->nullable();
            ## $table->foreign('aa_id_jenis_kategori_foreign')->references('id_jenis_kategori')->on('jenis_kategoris');
            $table->string('kategori_aset_aplikasi');
            $table->string('nama_aset_aplikasi');
            $table->string('ip_aset_aplikasi')->nullable();
            $table->string('server_aset_aplikasi')->nullable();
            $table->string('indeks_kami_aset_aplikasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_aplikasis');
        /*Schema::table('insidens', function (Blueprint $table) {
            $table->dropForeign(['aa_id_jenis_kategori_foreign']);
            $table->dropColumn('aa_id_jenis_kategori_foreign');;
        });*/
    }
};
