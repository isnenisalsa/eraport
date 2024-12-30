<?php

namespace Database\Factories;

use App\Models\SiswaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaModel>
 */
class SiswaModelFactory extends Factory
{
    protected $model = SiswaModel::class;

    public function definition()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia
        $nama = $faker->name();
        $tempat_lahir = $faker->city();

        return [
            'nis' => $faker->unique()->numerify('########'),
            'nisn' => $faker->unique()->numerify('##########'),
            'nama' => $nama,
            'pendidikan_terakhir' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
            'status' => 'Aktif',
            'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $faker->date(),
            'alamat' => $faker->address(),
            'jalan' => $faker->streetName(),
            'kelurahan' => $faker->city(), // Ganti citySuffix() dengan city() atau nama lain
            'kecamatan' => $faker->city(), // Ganti cityPrefix() dengan city() atau format lain
            'email' => $faker->email(),
            'kota' => $faker->city(),
            'provinsi' => $faker->state(),
            'nama_ayah' => $faker->name('male'),
            'nama_ibu' => $faker->name('female'),
            'pekerjaan_ayah' => $faker->jobTitle(),
            'pekerjaan_ibu' => $faker->jobTitle(),
            'no_telp_ayah' => $faker->phoneNumber(),
            'no_telp_ibu' => $faker->phoneNumber(),
            'nama_wali' => $faker->name(),
            'pekerjaan_wali' => $faker->jobTitle(),
            'no_telp_wali' => $faker->phoneNumber(),
            'alamat_wali' => $faker->address(),
            'username' => Str::slug($nama),
            'password' => bcrypt(str_replace(' ', '_', $tempat_lahir)),
        ];
    }
}
