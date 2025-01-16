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
        if (!Schema::hasTable('loans')) {
            Schema::create('loans', function (Blueprint $table) {
                $table->id();
                $table->date('application_date');
                $table->date('due_date');
                $table->decimal('loan_amount', 15, 2);
                $table->decimal('interest_rate', 5, 2);
                $table->unsignedBigInteger('loan_term_months');
                $table->decimal('monthly_installment', 15, 2);
                $table->enum('status', ['pending','approved','rejected','active','complete'])->default('pending');
                $table->unsignedBigInteger('member_id');
                $table->timestamps();

                $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
