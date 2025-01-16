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
        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->date('transaction_date');
                $table->enum('transaction_type', ['deposit','withdraw','payment']);
                $table->decimal('amount', 15, 2);
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
        Schema::dropIfExists('transactions');
    }
};
