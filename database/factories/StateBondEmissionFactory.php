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
        $date = $this->faker->dateTimeBetween('-2 years', '+3 years');
        $year = $date->format('y');
        $month = $date->format('m');

        return [
            'name'          => 'R'.$year.$month.$this->faker->randomElement(['A', 'B', 'C', 'AE', 'BE', 'CE']),
            'currency'      => $this->faker->randomElement(['RON', 'EUR']),
            'coupon_rate'   => $this->faker->randomFloat(2, 3, 9),
            'unit_value'    => 100,
            'maturity_date' => $date,
        ];
    }
}
