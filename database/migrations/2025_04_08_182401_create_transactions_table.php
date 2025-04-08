<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['checkin', 'checkout', 'adjustment']);
            $table->unsignedInteger('cash_payment')->default(0)->comment('Доплата наличными');
            $table->unsignedInteger('card_payment')->default(0)->comment('Доплата безнал');
            $table->unsignedInteger('cash_deposit')->default(0)->comment('Залог наличными');
            $table->unsignedInteger('card_deposit')->default(0)->comment('Залог безнал');
            $table->text('notes')->nullable();
            $table->timestamps();
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
