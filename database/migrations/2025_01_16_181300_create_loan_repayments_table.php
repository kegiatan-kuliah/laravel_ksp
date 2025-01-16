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
        if (!Schema::hasTable('loan_repayments')) {
            Schema::create('loan_repayments', function (Blueprint $table) {
                $table->id();
                $table->date('payment_date');
                $table->decimal('amount', 15, 2);
                $table->decimal('penalty_amount',15, 2)->default(0);
                $table->unsignedBigInteger('loan_id');
                $table->timestamps();

                $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_repayments');
    }
};
