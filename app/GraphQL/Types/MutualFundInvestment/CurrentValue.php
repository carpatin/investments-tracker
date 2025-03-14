<?php

declare(strict_types=1);

namespace App\GraphQL\Types\MutualFundInvestment;

use App\Models\MutualFundInvestment;

final readonly class CurrentValue
{
    public function __invoke(MutualFundInvestment $investment, array $args): float
    {
        $currentUnitValue = $investment->mutualFund->unit_value;

        return $currentUnitValue * $investment->unit_count;
    }
}
