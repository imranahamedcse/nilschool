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
        Schema::create('fees_assign_students_childs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fees_assign_student_id')->constrained('fees_assign_students')->cascadeOnDelete();
            $table->foreignId('fees_master_id')->constrained('fees_masters')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_assign_students_childs');
    }
};
