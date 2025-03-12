<?php

namespace App\Models;

use Database\Factories\BankDepositFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankDeposit extends Model
{
    /** @use HasFactory<BankDepositFactory> */
    use HasFactory;

    protected $casts = [
        'opening_date'  => 'date:Y-m-d', // only keeps the date part
        'maturity_date' => 'date:Y-m-d', // only keeps the date part
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
