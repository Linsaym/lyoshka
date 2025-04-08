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
        Schema::create('cash_register', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_cash')->default(0)->comment('Общие наличные');
            $table->unsignedInteger('total_card')->default(0)->comment('Общий безнал');
            $table->unsignedInteger('deposit_cash')->default(0)->comment('Залоги наличными');
            $table->unsignedInteger('deposit_card')->default(0)->comment('Залоги безнал');
            $table->unsignedInteger('free_cash')->virtualAs('total_cash - deposit_cash')->comment('Свободные наличные');
            $table->timestamp('recorded_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_registers');
    }
};
