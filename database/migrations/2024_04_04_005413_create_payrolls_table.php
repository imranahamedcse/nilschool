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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->cascadeOnDelete();
            $table->decimal('earning', 16,2)->default(0)->nullable();
            $table->decimal('deduction', 16,2)->default(0)->nullable();
            $table->decimal('leave_deduction', 16,2)->default(0)->nullable();
            $table->decimal('gross_salary', 16,2)->default(0)->nullable();
            $table->decimal('tax', 16,2)->default(0)->nullable();
            $table->decimal('net_salary', 16,2)->default(0)->nullable();
            $table->date('date')->nullable(); // month-year
            $table->date('pay_date')->nullable();

            $table->foreignId('expense_head')->nullable()->constrained('account_heads')->cascadeOnDelete();
            $table->string('payment_method')->nullable();

            $table->tinyInteger('status')->default(App\Enums\PayrollStatus::PENDING);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
