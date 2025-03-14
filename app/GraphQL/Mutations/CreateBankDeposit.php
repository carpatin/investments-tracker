<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Bank;
use App\Models\BankDeposit;
use App\Models\User;
use RuntimeException;
use Validator;

final readonly class CreateBankDeposit
{
    public function __invoke(null $_, array $args): BankDeposit
    {
        $input = $args['input'];

        // load related models
        $bank = Bank::find($input['bankId']);
        if (!$bank instanceof Bank) {
            throw new RuntimeException('Bank not found');
        }

        $user = User::find($input['ownerId']);
        if (!$user instanceof User) {
            throw new RuntimeException('User not found');
        }

        // prepare model creation data
        $data = [
            'currency'       => $input['currency'],
            'deposit_amount' => $input['depositAmount'],
            'interest_rate'  => $input['interestRate'],
            'opening_date'   => $input['openingDate'],
            'maturity_date'  => $input['maturityDate'],
            'is_revolving'   => $input['isRevolving'],
            'is_capitalized' => $input['isCapitalized'] ?? null,
        ];

        // validate the prepared model fields
        $validator = Validator::make($data, [
            'currency'       => 'required|string|regex:/^[A-Z]{3}$/',
            'deposit_amount' => 'required|numeric|min:0',
            'interest_rate'  => 'required|numeric|min:0.1|max:100',
            'opening_date'   => 'required|date',
            'maturity_date'  => 'required|date',
            'is_revolving'   => 'required|boolean',
            'is_capitalized' => 'boolean|nullable',
        ]);
        if ($validator->fails()) {
            throw new RuntimeException('Bank deposit data is not valid');
        }

        // create and persist deposit
        $deposit = new BankDeposit($validator->validated());
        $deposit->bank()->associate($bank);
        $deposit->owner()->associate($user);
        $deposit->save();

        return $deposit;
    }
}
