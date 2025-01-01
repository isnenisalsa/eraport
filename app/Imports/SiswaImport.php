<?php

namespace App\Imports;

use App\Models\SiswaModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    public function model(array $row)
    {
        $username = strtolower(str_replace(' ', '_', $row['nama']));
        $password = Hash::make(strtolower(str_replace(' ', '_', $row['tempat_lahir'])));

        // Cek apakah tanggal_lahir ada dan tidak kosong
        $tanggalLahir = !empty($row['tanggal_lahir']) ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d') : null;

        return new SiswaModel([
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'email' => $row['email'],
            'nama' => $row['nama'],
            'status' => $row['status'] ?? 'Aktif',
            'jenis_kelamin' => $row['jenis_kelamin'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggalLahir, // Menggunakan nilai yang sudah diproses
            'alamat' => $row['alamat'],
            'nama_ayah' => $row['nama_ayah'],
            'no_telp_ayah' => $row['no_telp_ayah'],
            'pekerjaan_ayah' => $row['pekerjaan_ayah'],
            'nama_ibu' => $row['nama_ibu'],
            'pekerjaan_ibu' => $row['pekerjaan_ibu'],
            'no_telp_ibu' => $row['no_telp_ibu'],
            'nama_wali' => $row['nama_wali'],
            'alamat_wali' => $row['alamat_wali'],
            'no_telp_wali' => $row['no_telp_wali'],
            'pekerjaan_wali' => $row['pekerjaan_wali'],
            'agama' => $row['agama'],
            'kota' => $row['kota'],
            'provinsi' => $row['provinsi'],
            'jalan' => $row['jalan'],
            'kelurahan' => $row['kelurahan'],
            'kecamatan' => $row['kecamatan'],
            'username' => $username,
            'password' => $password,
        ]);
    }
}
