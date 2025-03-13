<?php

namespace App\Models;

use Database\Factories\StateBondInvestmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StateBondInvestment extends Model
{
    /** @use HasFactory<StateBondInvestmentFactory> */
    use HasFactory;

    public function emission(): BelongsTo
    {
        return $this->belongsTo(StateBondEmission::class, 'state_bond_emission_id');
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'investor_id');
    }
}
