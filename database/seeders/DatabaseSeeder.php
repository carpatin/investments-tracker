<?php

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

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
                    ->count(3)
                    ->has(
                        MutualFundInvestment::factory()
                            ->count(50),
                        'investments'
                    ),
                'mutualFunds'
            )
            ->create();

        StateBondEmission::factory()
            ->count(5)
            ->has(
                StateBondInvestment::factory()
                    ->count(10),
                'investments'
            )
            ->create();
    }
}
