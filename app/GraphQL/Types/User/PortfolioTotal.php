<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use App\Models\User;

final readonly class PortfolioTotal
{
    public function __construct(
        private PortfolioCategoriesTotals $categoriesTotals
    ) {
        //
    }

    public function __invoke(User $user, array $args): array
    {
        $currency = $args['currency'];

        return [
            'total'    =>
                round(
                    $this->categoriesTotals->computeBankAccountsTotal($user, $currency) +
                    $this->categoriesTotals->computeBankDepositsTotal($user, $currency) +
                    $this->categoriesTotals->computeMutualFundsTotal($user, $currency) +
                    $this->categoriesTotals->computeStateBondsTotal($user, $currency),
                    2
                ),
            'currency' => $currency,
        ];
    }
}
