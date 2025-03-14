<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isInvestor(): bool
    {
        return $this->role === 'investor';
    }

    public function isAdminOrSelf($id): bool
    {
        return $this->isAdmin() || $this->id === (int) $id;
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'owner_id');
    }

    public function bankDeposits(): HasMany
    {
        return $this->hasMany(BankDeposit::class, 'owner_id');
    }

    public function mutualFundInvestments(): HasMany
    {
        return $this->hasMany(MutualFundInvestment::class, 'investor_id');
    }

    public function stateBondInvestments(): HasMany
    {
        return $this->hasMany(StateBondInvestment::class, 'investor_id');
    }
}
