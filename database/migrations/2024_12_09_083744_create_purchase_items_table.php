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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade'); // Foreign key to purchases table
            $table->integer('product_id'); // Create product_id column
            // Define the foreign key constraint for product_id
            $table->foreign('product_id')
                  ->references('product_id') // Reference to the product_id in products table
                  ->on('products') // Parent table
                  ->onDelete('cascade'); // Action on delete

            $table->integer('quantity'); // Quantity of the product
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
