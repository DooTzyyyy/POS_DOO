<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $hargaBeli = $this->faker->numberBetween(10000, 100000);

        return [
            'user_id' => User::query()->inRandomOrder()->first()?->id,
            'foto' => null,
            'nama' => $this->faker->words(3, true),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaBeli + $this->faker->numberBetween(5000, 100000),
            'stok' => $this->faker->numberBetween(1, 500),
        ];
    }
}
