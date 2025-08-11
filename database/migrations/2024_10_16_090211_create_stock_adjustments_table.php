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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productID')->constrained('products', 'id');
            $table->float('qty');
            $table->string("type");
            $table->text('notes')->nullable();
            $table->date('date');
            $table->string('batch')->nullable();
            $table->date('expiry')->nullable();
            /* $table->foreignId('warehouseID')->constrained('warehouses', 'id'); */
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
