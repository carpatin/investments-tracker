<?php

namespace App\Models;

use Database\Factories\MutualFundFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MutualFund extends Model
{
    /** @use HasFactory<MutualFundFactory> */
    use HasFactory;

    public function assetMgmtCompany(): BelongsTo
    {
        return $this->belongsTo(AssetMgmtCompany::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(MutualFundInvestment::class);
    }
}
