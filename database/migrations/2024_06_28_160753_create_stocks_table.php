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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productID')->constrained('products', 'id');
            $table->date('date');
            $table->float('cr')->default(0);
            $table->float('db')->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('refID');
            $table->string('batch')->nullable();
            $table->date('expiry')->nullable();
            /* $table->foreignId('warehouseID')->constrained('warehouses', 'id'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
