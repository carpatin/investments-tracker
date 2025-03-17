<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use App\Models\User;
use Illuminate\Support\Collection;

final readonly class PortfolioItems
{
    public function __invoke(User $user, array $args): Collection
    {
        $bankAccounts = $user->bankAccounts()->get();
        $bankDeposits = $user->bankDeposits()->get();
        $fundInvestments = $user->mutualFundInvestments()->get();
        $bondInvestments = $user->stateBondInvestments()->get();

        return $bankAccounts->merge($bankDeposits)->merge($fundInvestments)->merge($bondInvestments);
    }
}
