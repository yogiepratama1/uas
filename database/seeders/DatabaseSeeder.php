<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Advokat;
use App\Models\Aset;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Matakuliah::insert([
            [
                'nama' => 'Mata kuliah 1',
                'sks' => 2
            ],
            [
                'nama' => 'Mata kuliah 2',
                'sks' => 2
            ],
            [
                'nama' => 'Mata kuliah 3',
                'sks' => 2
            ],
            [
                'nama' => 'Mata kuliah 4',
                'sks' => 2
            ]
        ]);

        User::insert([
            [
                'nim' => mt_rand(1000000000, 9999999999),
                'name' => 'Mahasiswa 1',
                'jenis_kelamin' => 'l',
                'email' => 'mahasiswa1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'nim' => mt_rand(1000000000, 9999999999),
                'name' => 'Mahasiswa 2',
                'jenis_kelamin' => 'p',
                'email' => 'mahasiswa2@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'nim' => mt_rand(1000000000, 9999999999),
                'name' => 'Mahasiswa 3',
                'jenis_kelamin' => 'l',
                'email' => 'mahasiswa3@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'nim' => mt_rand(1000000000, 9999999999),
                'name' => 'Admin',
                'jenis_kelamin' => 'l',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
        ]);

        Nilai::insert([
            [
                'user_id' => 1,
                'matakuliah_id' => 1,
                'nilai_bobot' => 4,
                'nilai_total' => 100,
                'nilai_tugas' => 100,
                'nilai_uts' => 100,
                'nilai_uas' => 100,
            ],
            [
                'user_id' => 1,
                'matakuliah_id' => 2,
                'nilai_bobot' => 4,
                'nilai_total' => 100,
                'nilai_tugas' => 100,
                'nilai_uts' => 100,
                'nilai_uas' => 100,
            ],
            [
                'user_id' => 1,
                'matakuliah_id' => 3,
                'nilai_bobot' => 4,
                'nilai_total' => 100,
                'nilai_tugas' => 100,
                'nilai_uts' => 100,
                'nilai_uas' => 100,
            ],
            [
                'user_id' => 1,
                'matakuliah_id' => 4,
                'nilai_bobot' => 4,
                'nilai_total' => 100,
                'nilai_tugas' =>  100,
                'nilai_uts' =>  100,
                'nilai_uas' =>  100,
            ],
            [
                'user_id' => 2,
                'matakuliah_id' => 1,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ],
            [
                'user_id' => 2,
                'matakuliah_id' => 2,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ],
            [
                'user_id' => 2,
                'matakuliah_id' => 3,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ],
            [
                'user_id' => 2,
                'matakuliah_id' => 4,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ],
            [
                'user_id' => 3,
                'matakuliah_id' => 1,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ],
            [
                'user_id' => 3,
                'matakuliah_id' => 2,
                'nilai_bobot' => 3,
                'nilai_total' => 80,
                'nilai_tugas' => 80,
                'nilai_uts' => 80,
                'nilai_uas' => 80,
            ]
        ]);
    }
}
