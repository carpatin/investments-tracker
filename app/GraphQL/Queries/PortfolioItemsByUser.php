<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\BankAccount;
use App\Models\BankDeposit;
use App\Models\MutualFundInvestment;
use App\Models\StateBondInvestment;
use Illuminate\Support\Collection;

final readonly class PortfolioItemsByUser
{
    public function __invoke(null $_, array $args): Collection
    {
        $userId = $args['userId'];

        $bankAccounts = BankAccount::where('owner_id', $userId)->get();
        $bankDeposits = BankDeposit::where('owner_id', $userId)->get();
        $fundInvestments = MutualFundInvestment::where('investor_id', $userId)->get();
        $bondInvestments = StateBondInvestment::where('investor_id', $userId)->get();

        return $bankAccounts->merge($bankDeposits)->merge($fundInvestments)->merge($bondInvestments);
    }
}
