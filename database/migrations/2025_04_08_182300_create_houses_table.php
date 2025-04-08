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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Номер/название дома');
            $table->enum('status', [
                'needs_cleaning',
                'single_bed',
                'double_bed',
                'occupied',
                'staff'
            ])->default('needs_cleaning');
            $table->string('guest_name', 100)->nullable()->comment('Имя гостя');
            $table->string('check_out_date', 5)->nullable()->comment('Дата выезда в формате дд.мм');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
