<?php

namespace Database\Factories;

use App\Models\JenisUsaha;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisUsaha>
 */
class JenisUsahaFactory extends Factory
{

    protected $model = JenisUsaha::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->name(),
            //
        ];
    }
}
