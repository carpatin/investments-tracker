<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\FieldNameCaseMapper;
use App\Models\AssetMgmtCompany;
use App\Models\MutualFund;
use Illuminate\Support\Collection;

final readonly class SearchMutualFunds
{
    use FieldNameCaseMapper;

    public function __invoke(null $_, array $args): Collection
    {
        $criteria = $this->toSnakeCaseKeys($args['criteria']);
        // extract the search criteria for asset managers
        $assetManagerCriteria = $criteria['asset_manager'];
        unset($criteria['asset_manager']);

        // prepare LIKE clause in case the asset manager name field is present
        if (isset($assetManagerCriteria['name'])) {
            $name = trim($assetManagerCriteria['name']);
            unset($assetManagerCriteria['name']);
            $assetManagerCriteria[] = ['name', 'like', '%'.$name.'%'];
        }

        // obtain the matching asset managers and collect their IDs
        $assetManagerIds = AssetMgmtCompany::where($assetManagerCriteria)->pluck('id')->toArray();
        if (empty($assetManagerIds)) {
            return Collection::empty();
        }

        // obtain the mutual funds that belong to any of the found managers adding extra match criteria
        return MutualFund::whereIn('asset_mgmt_company_id', $assetManagerIds)->where($criteria)->get();
    }
}
