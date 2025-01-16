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
        if (!Schema::hasTable('saving_accounts')) {
            Schema::create('saving_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('account_number');
                $table->decimal('balance', 12, 2);
                $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('saving_accounts');
    }
};
