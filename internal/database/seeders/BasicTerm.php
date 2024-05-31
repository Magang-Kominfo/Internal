<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicTerm extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sifats')->insert([
            ['nama_sifat' => 'Mendesak'],
            ['nama_sifat' => 'Penting'],
            ['nama_sifat' => 'Cukup Penting'],
            ['nama_sifat' => 'Spam'],
        ]);

        DB::table('alur_surats')->insert([
            ['nama_alur_surat' => 'Surat Masuk'],
            ['nama_alur_surat' => 'Surat Keluar'],
        ]);

        DB::table('korespondens')->insert([
            [
                'nama_koresponden' => 'Kominfo Pusat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_koresponden' => 'Kominfo Jawa Timur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_koresponden' => 'Kominfo Jawa tengah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_koresponden' => 'Kominfo Jawa Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_koresponden' => 'Kominfo Sulawesi tengah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_koresponden' => 'Kominfo Sulawesi Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('emails')->insert([
            [
                'id_koresponden' => 1,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.pusat@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 2,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.jatim@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 2,
                'tipe_email' => 1,
                'nama_email' => 'jokopinurbo12@kominfo.jatim.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 2,
                'tipe_email' => 1,
                'nama_email' => 'Purbasari.ayuningsih@kominfo.jatim.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 3,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.jateng@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 3,
                'tipe_email' => 1,
                'nama_email' => 'Krisna.simarahi@kominfo.jateng.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 4,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.jabar@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 5,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.sulteng@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 5,
                'tipe_email' => 1,
                'nama_email' => 'Padi.simulandari@kominfo.sulteng.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_koresponden' => 6,
                'tipe_email' => 0,
                'nama_email' => 'Kominfo.sulsel@kominfo.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
