<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AssetMgmtCompany;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankDeposit;
use App\Models\MutualFund;
use App\Models\MutualFundInvestment;
use App\Models\StateBondEmission;
use App\Models\StateBondInvestment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create(
            [
                'name'  => 'Administrator',
                'email' => 'admin@investments.com',
                'role'  => 'admin',
            ]
        );

        User::factory(10)->create();
        Bank::factory()
            ->count(7)
            ->has(
                BankAccount::factory()
                    ->count(3),
                'accounts'
            )
            ->has(
                BankDeposit::factory()
                    ->count(3),
                'deposits'
            )
            ->create();

        AssetMgmtCompany::factory()
            ->count(3)
            ->has(
                MutualFund::factory()
                    ->count(20)
                    ->has(
                        MutualFundInvestment::factory()
                            ->count(20),
                        'investments'
                    ),
                'mutualFunds'
            )
            ->create();

        StateBondEmission::factory()
            ->count(20)
            ->has(
                StateBondInvestment::factory()
                    ->count(10),
                'investments'
            )
            ->create();
    }
}
