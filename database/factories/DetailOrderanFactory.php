<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailOrderan>
 */
class DetailOrderanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_transaksi' => $this->faker->ean8(),
            'notrx' => $this->faker->ean8(),
            'id_pelanggan' => $this->faker->numberBetween(1, 10),
            'namabarang' => $this->faker->name(),
            'keterangan' => $this->faker->text(),
            'jumlah' => $this->faker->randomDigitNot(0),
            'harga' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'uangmuka' => $this->faker->numberBetween(1000, 9000),
            'subtotal' => $this->faker->randomFloat(),
            'sisa' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(['Belum Lunas']),
            'name_kasir' => $this->faker->randomElement(['KhalidR', 'YusufR']),
            'created_at' => DateTime::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s')),
            'updated_at' => DateTime::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s')),
        ];
    }
}
