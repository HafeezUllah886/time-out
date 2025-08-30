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
        Schema::create('return_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('returnID')->constrained('returns', 'id');
            $table->foreignId('productID')->constrained('products', 'id');
            $table->float('price', 10);
            $table->float('qty');
            $table->float('amount');
            $table->date('date');
            $table->string('batch')->nullable();
            $table->foreignId('userID')->constrained('users', 'id');
            $table->foreignId('accountID')->constrained('accounts', 'id');
            $table->date('expiry')->nullable();
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_details');
    }
};
