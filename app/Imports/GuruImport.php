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
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GuruImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
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
            'nik' => $row['nik'],
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'status' => $row['status'] ?? 'Aktif',
            'jenis_kelamin' => $row['jenis_kelamin'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d'),
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

    /**
     * Define the validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nik' => 'required|numeric|digits:16|unique:guru,nik',
            'nip' => 'nullable|numeric|unique:guru,nip',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'pendidikan_terakhir' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => [
                'required',
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

            'alamat' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'agama' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'no_telp' => 'required|numeric',
            'status_perkawinan' => 'required|string|in:Belum Menikah,Menikah',
            'email' => 'required',
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
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin hanya boleh Laki-Laki atau Perempuan.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa format tanggal yang valid.',
            'email.required' => 'Email wajib diisi.',
        ];
    }
}
