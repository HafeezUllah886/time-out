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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customerID')->constrained('accounts', 'id');
            $table->string('customerName')->nullable();
            $table->date('date');
            $table->float('total')->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('refID');
            $table->foreignId('userID')->constrained('users', 'id');
            $table->foreignId('accountID')->constrained('accounts', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
