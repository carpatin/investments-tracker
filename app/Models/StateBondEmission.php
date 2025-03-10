<?php

namespace App\Models;

use Database\Factories\StateBondEmissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StateBondEmission extends Model
{
    /** @use HasFactory<StateBondEmissionFactory> */
    use HasFactory;

    public function investments(): HasMany
    {
        return $this->hasMany(StateBondInvestment::class);
    }
}
