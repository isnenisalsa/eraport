<?php

namespace App\Imports;

use App\Models\GuruModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruImport implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $username = strtolower(str_replace(' ', '_', $row['nama']));
        $password = Hash::make(strtolower(str_replace(' ', '_', $row['tempat_lahir'])));
        return new GuruModel([
            //
            'nik' => $row['nik'],
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'status' => $row['status'] ?? 'Aktif',
            'jenis_kelamin' => $row['jenis_kelamin'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' =>  $row['tanggal_lahir'],
            'alamat' => $row['alamat'],
            'nama_ibu' => $row['nama_ibu'],
            'agama' => $row['agama'],
            'jabatan' => $row['jabatan'],
            'no_telp' => $row['no_telp'],
            'status_perkawinan' => $row['status_perkawinan'],
            'email' => $row['email'],
            'username' => $username,
            'password' => $password,


        ]);
        
    }
    public function rules(): array
    {
        return [
            'nik' => 'required|unique:guru|digits:16|numeric',
            'nip' => 'required|digits:10|numeric'

        ];
    }
}
