<?php

namespace Database\Seeders;

use App\Models\GuruModel;
use App\Models\RolesModel;
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
        RolesModel::create([
            'nama' => 'admin',
        ]);
        RolesModel::create([
            'nama' => 'guru',
        ]);
        RolesModel::create([
            'nama' => 'walas',
        ]);
        GuruModel::create([
            'nik' => '1234567890123457',
            'nip' => '12345671',
            'nama' => 'Jane Smith',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1992-02-02',
            'jenis_kelamin' => 'P',
            'nama_ibu' => 'Mary Smith',
            'agama' => 'Kristen',
            'jabatan' => 'guru',
            'pendidikan_terakhir' => 's1',
            'no_telp' => '0731213141',
            'status_perkawinan' => 'Menikah',
            'email' => 'janesmith@example.com',
            'username' => 'janesmith',
            'alamat' => 'bjb',
            'password' => Hash::make('password'),

        ]);

    }
}
