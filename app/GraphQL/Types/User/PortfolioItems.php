<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use App\Models\BankAccount;
use App\Models\BankDeposit;
use App\Models\MutualFundInvestment;
use App\Models\StateBondInvestment;
use App\Models\User;
use Illuminate\Support\Collection;

final readonly class PortfolioItems
{
    public function __invoke(User $user, array $args): Collection
    {
        $userId = $user->id;

        $bankAccounts = BankAccount::where('owner_id', $userId)->get();
        $bankDeposits = BankDeposit::where('owner_id', $userId)->get();
        $fundInvestments = MutualFundInvestment::where('investor_id', $userId)->get();
        $bondInvestments = StateBondInvestment::where('investor_id', $userId)->get();

        return $bankAccounts->merge($bankDeposits)->merge($fundInvestments)->merge($bondInvestments);
    }
}
