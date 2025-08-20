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
        Schema::create('counter_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users','id');
            $table->foreignId('accountID')->constrained('accounts','id');
            $table->date('date');
            $table->integer('amount');
            $table->string('type');
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counter_transactions');
    }
};
