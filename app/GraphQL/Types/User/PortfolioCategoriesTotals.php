<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use App\GraphQL\Scalars\PortfolioCategoryType;
use App\Models\MutualFundInvestment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final readonly class PortfolioCategoriesTotals
{
    public function __invoke(User $user, array $args): array
    {
        $currency = $args['currency'];

        return [
            [
                'total'             => round(
                    $this->computeBankAccountsTotal($user, $currency)
                    + $this->computeBankDepositsTotal($user, $currency),
                    2
                ),
                'portfolioCategory' => PortfolioCategoryType::BANKS,
                'currency'          => $currency,
            ],
            [
                'total'             => round($this->computeMutualFundsTotal($user, $currency), 2),
                'portfolioCategory' => PortfolioCategoryType::FUNDS,
                'currency'          => $currency,
            ],
            [
                'total'             => round($this->computeStateBondsTotal($user, $currency), 2),
                'portfolioCategory' => PortfolioCategoryType::BONDS,
                'currency'          => $currency,
            ],
        ];
    }

    public function computeBankAccountsTotal(User $user, string $currency): float
    {
        return (float)$user
            ->bankAccounts()
            ->where('currency', $currency)
            ->sum('amount');
    }

    public function computeBankDepositsTotal(User $user, string $currency): float
    {
        return (float)$user
            ->bankDeposits()
            ->where('currency', $currency)
            ->sum('deposit_amount');
    }

    public function computeMutualFundsTotal(User $user, string $currency): float
    {
        $mutualFundsInvestments = $user
            ->mutualFundInvestments()
            ->whereHas(
                'mutualFund',
                function (Builder $query) use ($currency) {
                    $query->where('currency', $currency);
                }
            )
            ->get(['unit_count', 'unit_value']);

        return $mutualFundsInvestments->reduce(function ($carry, MutualFundInvestment $investment) {
            return $carry + $investment->unit_count * $investment->unit_value;
        }, 0);
    }

    public function computeStateBondsTotal(User $user, string $currency): float
    {
        return (float)$user
            ->stateBondInvestments()
            ->whereHas(
                'emission',
                function (Builder $query) use ($currency) {
                    $query->where('currency', $currency);
                }
            )
            ->sum('principal');
    }
}
