<?php

namespace App\Models;

use Database\Factories\MutualFundInvestmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutualFundInvestment extends Model
{
    /** @use HasFactory<MutualFundInvestmentFactory> */
    use HasFactory;

    public function mutualFund(): BelongsTo
    {
        return $this->belongsTo(MutualFund::class);
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'investor_id');
    }
}
