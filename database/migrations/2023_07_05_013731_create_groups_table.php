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
        if (!Schema::hasTable('group_admin')) {

            Schema::create('group_admin', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->id();
                $table->string('group_name',150)->nullable(false)->default('');
                $table->unsignedInteger('group_admin_id')->nullable();
                $table->string('email',150)->nullable(false)->default('');
                $table->timestamps();
            });

        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_admin');
    }
};
