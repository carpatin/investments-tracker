<?php

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_deposits', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bank::class);
            $table->foreignIdFor(User::class, 'owner_id');
            $table->string('currency', 3);
            $table->decimal('deposit_amount');
            $table->decimal('interest_rate');
            $table->date('opening_date');
            $table->date('maturity_date');
            $table->boolean('is_revolving');
            $table->boolean('is_capitalized')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_deposits');
    }
};
