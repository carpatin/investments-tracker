<?php

namespace App\Models;

use Database\Factories\BankFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    /** @use HasFactory<BankFactory> */
    use HasFactory;

    protected $guarded = ['id']; // protects 'id', everything else is fillable

    public function accounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(BankDeposit::class);
    }
}
