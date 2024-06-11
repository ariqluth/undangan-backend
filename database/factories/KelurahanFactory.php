<?php

namespace Database\Factories;

use App\Models\Kelurahan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelurahan>
 */
class KelurahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Kelurahan::class;

    public function definition()
    {
        return [
            // 'nm_kelurahan' => $this->faker->name(),
            // 'status' => $this->faker->random(['desa','kelurahan']),
        ];
    }
}
