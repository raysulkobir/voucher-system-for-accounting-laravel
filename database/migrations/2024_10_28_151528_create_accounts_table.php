<?php

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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('account_type'); // e.g., 'asset', 'liability', 'income', 'expense'
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->string('account_number')->unique()->nullable();
            $table->string('bank_name')->nullable();
            $table->string('currency', 3)->default('USD'); // ISO 4217 currency code, e.g., 'USD'
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
