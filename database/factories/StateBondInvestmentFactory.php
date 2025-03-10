<?php

namespace Database\Factories;

use App\Models\StateBondEmission;
use App\Models\StateBondInvestment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StateBondInvestment>
 */
class StateBondInvestmentFactory extends Factory
{
    public function definition(): array
    {
        $unitCount = $this->faker->numberBetween(10, 10000);

        return [
            'state_bond_emission_id' => StateBondEmission::inRandomOrder()->first()->id ?? StateBondEmission::factory(
                )->create()->id,
            'investor_id'            => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'principal'              => $unitCount * 100,
            'unit_count'             => $unitCount,
            'unit_value'             => 100,
        ];
    }
}
