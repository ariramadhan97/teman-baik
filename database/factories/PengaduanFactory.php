<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "tgl_aduan" => fake()->date(),
            "nama" => fake()->name(),
            "id_instansi" => 1,
            "id_status" => 1,
            "telepon" => fake()->e164PhoneNumber(),
            "aduan" => fake()->paragraph(),
            "alamat" => fake()->address(),
            "penginput" => "admin",
            "nama_file" => "aduan.jpg"
        ];
    }
}
