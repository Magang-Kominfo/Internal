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
        Schema::create('insidens', function (Blueprint $table) {
            $table->id('insiden_id');
            $table->unsignedBigInteger('insidens_odp_id_foreign');
            $table->foreign('insidens_odp_id_foreign')->references('odp_id')->on('master_odps');
            $table->unsignedBigInteger('insidens_id_jenis_insiden_foreign');
            $table->foreign('insidens_id_jenis_insiden_foreign')->references('id_jenis_insiden')->on('jenis_insidens');
            $table->string('resiko_insiden')->nullable();
            $table->string('status_insiden')->nullable();
            $table->string('status_setelah_unsuspend_insiden')->nullable();
            $table->string('url_insiden')->nullable();
            $table->string('nomor_surat_tte_insiden')->nullable();
            $table->text('keterangan_insiden')->nullable();
            $table->date('tanggal_surat_tte_insiden')->nullable();
            $table->date('tanggal_suspend_insiden')->nullable();
            $table->date('tanggal_pemulihan_insiden')->nullable();
            $table->time('jam_insiden_diselesaikan')->nullable();
            $table->date('tanggal_insiden_diselesaikan')->nullable();
            $table->date('tanggal_notifikasi_insiden')->nullable();
            $table->time('jam_temuan_insiden')->nullable();
            $table->time('jam_temuan_dikirim_insiden')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insidens');
        Schema::table('insidens', function (Blueprint $table) {
            $table->dropForeign(['insidens_odp_id_foreign']);
            $table->dropColumn('insidens_odp_id_foreign');
            $table->dropForeign(['insidens_id_jenis_insiden_foreign']);
            $table->dropColumn('insidens_id_jenis_insiden_foreign');
        });
    }
};
