<?php

use App\Models\StateBondEmission;
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
        Schema::create('state_bond_investments', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StateBondEmission::class);
            $table->foreignIdFor(User::class);
            $table->decimal('principal');
            $table->unsignedInteger('unit_count');
            $table->decimal('unit_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_bond_investments');
    }
};
