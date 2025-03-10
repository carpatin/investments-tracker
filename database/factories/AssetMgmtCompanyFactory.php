<?php

namespace Database\Factories;

use App\Models\AssetMgmtCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssetMgmtCompany>
 */
class AssetMgmtCompanyFactory extends Factory
{
    public function definition(): array
    {
        $companies = ['BRD Asset Management', 'BT Capital Partners', 'SAI Erste Asset Management'];

        return [
            'name' => $this->faker->unique()->randomElement($companies),
        ];
    }
}
