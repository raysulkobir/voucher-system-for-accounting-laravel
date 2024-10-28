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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique(); // Unique ID for each transaction
            $table->unsignedBigInteger('voucher_id')->nullable(); // Links to voucher
            $table->decimal('total_amount', 15, 2); // Total amount for the transaction
            $table->enum('transaction_type', ['sale', 'purchase', 'payment', 'receipt']); // Type of transaction
            $table->date('transaction_date'); // Date of transaction
            $table->text('description')->nullable(); // Optional description
            $table->timestamps();

            // Foreign keys
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
