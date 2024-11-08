<?php

namespace Database\Seeders;

use App\Models\GuruModel;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan untuk mengimpor model yang tepat
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GuruModel::create([
            'nik' => '1234567890123456',
            'nama' => 'John Doe',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'nama_ibu' => 'Jane Doe',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Menikah',
            'email' => 'johndoe@example.com',
            'username' => 'johndoe',
            'password' => Hash::make('password123'), // Pastikan untuk mengenkripsi password
            'roles_id' => 1, // Sesuaikan dengan id role yang ada
        ]);

        // Anda bisa menambahkan lebih banyak data atau menggunakan loop untuk banyak data
        GuruModel::create([
            'nik' => '1234567890123457',
            'nama' => 'Jane Smith',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1992-02-02',
            'jenis_kelamin' => 'P',
            'nama_ibu' => 'Mary Smith',
            'agama' => 'Kristen',
            'status_perkawinan' => 'Menikah',
            'email' => 'janesmith@example.com',
            'username' => 'janesmith',
            'password' => Hash::make('password123'),
            'roles_id' => 2,
        ]);

        GuruModel::create([
            'nik' => '1234567890123458',
            'nama' => 'Isna',
            'tempat_lahir' => 'Tanah Laut',
            'tanggal_lahir' => '2005-01-03',
            'jenis_kelamin' => 'P',
            'nama_ibu' => 'ppppp',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum',
            'email' => 'isna@example.com',
            'username' => 'isna',
            'password' => Hash::make('password123'),
            'roles_id' => 3,
        ]);
    }
}
