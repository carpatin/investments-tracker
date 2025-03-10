<?php

namespace Database\Factories;

use App\Models\StateBondEmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StateBondEmission>
 */
class StateBondEmissionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'          => 'R'.$this->faker->numberBetween(25, 35).
                $this->faker->numberBetween(1, 12).
                $this->faker->randomElement(['A', 'B', 'C', 'AE', 'BE', 'CE']),
            'currency'      => $this->faker->randomElement(['RON', 'EUR']),
            'coupon_rate'   => $this->faker->randomFloat(2, 3, 9),
            'unit_value'    => 100,
            'maturity_date' => $this->faker->dateTimeBetween('-3 years', '+6 years'),
        ];
    }
}
