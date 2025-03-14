<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\StateBondEmission;
use Illuminate\Support\Collection;

final readonly class StateBondsByMaturity
{
    public function __invoke(null $_, array $args): Collection
    {
        $year = $args['maturityYear'];
        $month = $args['maturityMonth'] ?? null;

        $builder = StateBondEmission::whereYear('maturity_date', $year);

        if (null !== $month) {
            $builder->whereMonth('maturity_date', $month);
        }

        return $builder->get();
    }
}
