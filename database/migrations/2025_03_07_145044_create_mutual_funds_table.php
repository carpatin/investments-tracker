<?php

use App\Models\AssetMgmtCompany;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mutual_funds', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AssetMgmtCompany::class);
            $table->string('name', 30);
            $table->string('currency', 3);
            $table->decimal('unit_value');
            $table->enum('risk_indicator', ['low', 'medium', 'high'])->default('low');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutual_funds');
    }
};
