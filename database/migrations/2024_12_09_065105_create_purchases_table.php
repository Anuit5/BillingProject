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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email'); // Email of the customer
            $table->float('total_amount', 10, 2); // Total amount of the purchase
            $table->float('cash_paid', 10, 2); // Cash paid by the customer
            $table->float('change_due', 10, 2); // Change to be returned to the customer
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
