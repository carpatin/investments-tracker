<?php

namespace Database\Factories;

use App\Models\AssetMgmtCompany;
use App\Models\MutualFund;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MutualFund>
 */
class MutualFundFactory extends Factory
{
    public function definition(): array
    {
        $fundNames = [
            'Simfonia',
            'Orizont',
            'Global',
            'Fix',
            'Plus',
            'ROTX',
            'Obligatiuni',
            'Oportunitati',
            'Actiuni',
            'Simplu',
            'Energie',
            'Agro',
            'Clasic',
            'Technology',
            'Semiconductors',
            'Fintech',
        ];

        return [
            'asset_mgmt_company_id' =>
                AssetMgmtCompany::inRandomOrder()->first()->id ?? AssetMgmtCompany::factory()->create()->id,
            'name'                  => $this->faker->randomElement($fundNames).' '.$this->faker->numberBetween(1, 100),
            'currency'              => $this->faker->randomElement(['RON', 'EUR']),
            'unit_value'            => $this->faker->randomFloat(2, 50, 150),
            'risk_indicator'        => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }
}
