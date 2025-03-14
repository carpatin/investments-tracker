<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\FieldNameCaseMapper;
use App\Models\MutualFund;
use App\Models\MutualFundInvestment;
use App\Models\User;
use RuntimeException;
use Validator;

final readonly class CreateMutualFundInvestment
{
    use FieldNameCaseMapper;

    public function __invoke(null $_, array $args): MutualFundInvestment
    {
        $input = $args['input'];

        // load related models
        $mutualFund = MutualFund::find($input['mutualFundId']);
        if (!$mutualFund instanceof MutualFund) {
            throw new RuntimeException('Mutual fund not found');
        }
        $investor = User::find($input['investorId']);
        if (!$investor instanceof User) {
            throw new RuntimeException('Investor user not found');
        }

        // prepare model creation data by changing remaining input keys to snake_case
        unset($input['mutualFundId'], $input['investorId']);
        $data = $this->toSnakeCaseKeys($input);

        // validate the input fields
        $validator = Validator::make($data, [
            'unit_count'      => 'required|numeric|min:1',
            'unit_value'      => 'required|numeric|min:1',
            'investment_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            throw new RuntimeException('Mutual fund investment data is not valid');
        }

        // create and persist investment
        $investment = new MutualFundInvestment($validator->validated());
        $investment->mutualFund()->associate($mutualFund);
        $investment->investor()->associate($investor);
        $investment->save();

        return $investment;
    }
}
