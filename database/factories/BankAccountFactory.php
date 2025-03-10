<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankAccount>
 */
class BankAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bank_id'  => Bank::inRandomOrder()->first()->id ?? Bank::factory()->create()->id,
            'owner_id'  => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'currency' => $this->faker->randomElement(['RON', 'EUR']),
            'amount'   => $this->faker->randomFloat(2, 10, 50000),
            'iban'     => $this->faker->iban('RO'),
        ];
    }
}
