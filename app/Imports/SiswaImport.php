<?php

namespace App\Imports;

use App\Models\SiswaModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        $username = strtolower(str_replace(' ', '_', $row['nama']));
        $password = Hash::make(strtolower(str_replace(' ', '_', $row['tempat_lahir'])));

        // Cek apakah tanggal_lahir ada dan tidak kosong
        $tanggalLahir = !empty($row['tanggal_lahir'])
            ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d')
            : null;

        return new SiswaModel([
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'email' => $row['email'],
            'nama' => $row['nama'],
            'status' => $row['status'] ?? 'Aktif',
            'jenis_kelamin' => $row['jenis_kelamin'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggalLahir,
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

    /**
     * Define the validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|string|max:255|unique:siswa,nis',
            'nisn' => 'nullable',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    try {
                        $date = Date::excelToDateTimeObject($value)->format('Y-m-d');
                        if (!$date) {
                            $fail("$attribute tidak valid.");
                        }
                    } catch (\Exception $e) {
                        $fail("$attribute harus berupa tanggal Excel yang valid.");
                    }
                }
            ],
            'email' => 'nullable',
            'no_telp_ayah' => 'nullable',
            'no_telp_ibu' => 'nullable',
            'no_telp_wali' => 'nullable',
        ];
    }

    /**
     * Customize the validation messages.
     *
     * @return array
     */
    public function customValidationMessages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin hanya boleh Laki-Laki atau Perempuan.',
            'agama.required' => 'Agama wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'no_telp_ayah.numeric' => 'Nomor telepon ayah harus berupa angka.',
            'no_telp_ibu.numeric' => 'Nomor telepon ibu harus berupa angka.',
            'no_telp_wali.numeric' => 'Nomor telepon wali harus berupa angka.',
        ];
    }
}
