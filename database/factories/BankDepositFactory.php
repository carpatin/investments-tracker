<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankDeposit>
 */
class BankDepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_id'        => Bank::inRandomOrder()->first()->id ?? Bank::factory()->create()->id,
            'owner_id'        => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'currency'       => $this->faker->randomElement(['RON', 'EUR']),
            'deposit_amount' => $this->faker->randomFloat(2, 10, 50000),
            'interest_rate'  => $this->faker->randomFloat(2, 2, 8),
            'opening_date'   => $this->faker->dateTimeBetween('-2 years'),
            'maturity_date'  => $this->faker->dateTimeBetween('now', '+2 years'),
            'is_capitalized' => $this->faker->boolean(),
            'is_revolving'   => $this->faker->boolean(),
        ];
    }
}
