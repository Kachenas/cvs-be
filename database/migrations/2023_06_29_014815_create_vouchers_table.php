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
        if (!Schema::hasTable('vouchers')) {

            Schema::create('vouchers', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->id();
                $table->unsignedInteger('user_id')->nullable();
                $table->unsignedInteger('group_id')->nullable();
                $table->string('voucher_code',20);
                $table->timestamps();
            });

        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
