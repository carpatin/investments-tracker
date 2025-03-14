<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\FieldNameCaseMapper;
use App\Models\StateBondEmission;
use App\Models\StateBondInvestment;
use App\Models\User;
use RuntimeException;
use Validator;

final readonly class CreateStateBondInvestment
{
    use FieldNameCaseMapper;

    public function __invoke(null $_, array $args): StateBondInvestment
    {
        $input = $args['input'];

        // load related models
        $emission = StateBondEmission::find($input['emissionId']);
        if (!$emission instanceof StateBondEmission) {
            throw new RuntimeException('State bonds emission not found');
        }
        $investor = User::find($input['investorId']);
        if (!$investor instanceof User) {
            throw new RuntimeException('Investor user not found');
        }

        // prepare model creation data by changing remaining input keys to snake_case
        unset($input['emissionId'], $input['investorId']);
        $data = $this->toSnakeCaseKeys($input);

        // compute the principal
        $data['principal'] = $data['unit_count'] * $data['unit_value'];

        // validate the input fields
        $validator = Validator::make($data, [
            'unit_count' => 'required|integer|min:1',
            'unit_value' => 'required|numeric|min:1',
            'principal'  => 'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            throw new RuntimeException('State bonds investment data is not valid');
        }

        // create and persist investment
        $investment = new StateBondInvestment($validator->validated());
        $investment->emission()->associate($emission);
        $investment->investor()->associate($investor);
        $investment->save();

        return $investment;
    }
}
