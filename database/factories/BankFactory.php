<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bank>
 */
class BankFactory extends Factory
{
    public function definition(): array
    {
        $banks = [
            'BRD',
            'BT',
            'BCR',
            'Raiffeisen Bank',
            'CEC Bank',
            'Alpha Bank',
            'Libra Bank',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($banks),
        ];
    }
}
