<?php

namespace App\Models;

use Database\Factories\AssetMgmtCompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetMgmtCompany extends Model
{
    /** @use HasFactory<AssetMgmtCompanyFactory> */
    use HasFactory;

    public function mutualFunds(): HasMany
    {
        return $this->hasMany(MutualFund::class);
    }
}
