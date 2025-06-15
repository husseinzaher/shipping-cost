<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AreaFactory extends Factory
{
    protected $model = Area::class;

    public function definition(): array
    {
        return [
            'city' => $this->faker->city(),
            'area' => $this->faker->word(),
            'type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
