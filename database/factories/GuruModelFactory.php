<?php

namespace Database\Factories;

use App\Models\GuruModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GuruModelFactory extends Factory
{
    protected $model = GuruModel::class;
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->randomNumber(8, true),
            'nip' => $this->faker->unique()->randomNumber(8, true),
            'nama' => $name = $this->faker->name(),
            'tempat_lahir' => $birthplace = $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'nama_ibu' => $this->faker->name('female'),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->address(),
            'status_perkawinan' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
            'jabatan' => $this->faker->jobTitle(),
            'status' => 'Aktif',
            'pendidikan_terakhir' => $this->faker->randomElement(['SMA', 'D3', 'S1', 'S2', 'S3']),
            'no_telp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => Str::slug($name),
            'password' => bcrypt(str_replace(' ', '_', $birthplace)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
