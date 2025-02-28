<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('state_bond_emissions', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('currency', 3);
            $table->decimal('coupon_rate');
            $table->decimal('unit_value');
            $table->date('maturity_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_bond_emissions');
    }
};
