<?php

namespace Database\Factories;

use App\Models\MutualFund;
use App\Models\MutualFundInvestment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MutualFundInvestment>
 */
class MutualFundInvestmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mutual_fund_id'  => MutualFund::inRandomOrder()->first()->id ?? MutualFund::factory()->create()->id,
            'investor_id'     => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'unit_count'      => $this->faker->numberBetween(1, 30),
            'unit_value'      => $this->faker->randomFloat(2, 50, 150),
            'investment_date' => $this->faker->dateTimeBetween('-3 years'),
        ];
    }
}
