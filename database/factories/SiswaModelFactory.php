<?php

namespace Database\Factories;

use App\Models\SiswaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaModel>
 */
class SiswaModelFactory extends Factory
{

    protected $model = SiswaModel::class;
    public function definition()
    {
        $nama = $this->faker->name();
        $tempat_lahir = $this->faker->city();

        return [
            'nis' => $this->faker->unique()->numerify('########'),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'nama' => $nama,
            'pendidikan_terakhir' => $this->faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
            'status' => 'Aktif',
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'jalan' => $this->faker->streetName(),
            'kelurahan' => $this->faker->citySuffix(),
            'kecamatan' => $this->faker->cityPrefix(),
            'kota' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
            'nama_ayah' => $this->faker->name('male'),
            'nama_ibu' => $this->faker->name('female'),
            'pekerjaan_ayah' => $this->faker->jobTitle(),
            'pekerjaan_ibu' => $this->faker->jobTitle(),
            'no_telp_ayah' => $this->faker->phoneNumber(),
            'no_telp_ibu' => $this->faker->phoneNumber(),
            'nama_wali' => $this->faker->name(),
            'pekerjaan_wali' => $this->faker->jobTitle(),
            'no_telp_wali' => $this->faker->phoneNumber(),
            'alamat_wali' => $this->faker->address(),
            'username' => Str::slug($nama),
            'password' => bcrypt(str_replace(' ', '_', $tempat_lahir)),
        ];
    }
}
