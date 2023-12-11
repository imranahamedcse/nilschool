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
        Schema::create('dormitory_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dormitory_id')->constrained('dormitories')->cascadeOnDelete();
            $table->tinyInteger('status')->default(App\Enums\Status::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitory_setups');
    }
};
