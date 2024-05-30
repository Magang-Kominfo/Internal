<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            [
                'id_user' => '1234',
                'nama_user' => 'superadmin',
                'role' => 'superadmin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ],
            [
                'id_user' => '10123',
                'nama_user' => 'insiden',
                'role' => 'insiden',
                'password' => bcrypt('insiden'),
                'is_admin' => false,
            ],
            [
                'id_user' => '20123',
                'nama_user' => 'berita',
                'role' => 'berita',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ],
            [
                'id_user' => '30123',
                'nama_user' => 'aset',
                'role' => 'aset',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
