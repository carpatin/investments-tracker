<?php

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_accounts', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bank::class);
            $table->foreignIdFor(User::class, 'owner_id');
            $table->string('currency', 3);
            $table->decimal('amount');
            $table->string('iban', 34);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
