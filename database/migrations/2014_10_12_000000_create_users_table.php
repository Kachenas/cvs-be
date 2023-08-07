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
        if (!Schema::hasTable('users')) {

            Schema::create('users', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->id();
                $table->string('first_name',150)->nullable(false)->default('');
                $table->string('middle_name',150)->nullable(false)->default('');
                $table->string('last_name',150)->nullable(false)->default('');
                $table->string('email',150)->unique();
                $table->unsignedInteger('user_role')->nullable()->default(1);
                $table->unsignedInteger('group_id')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->text('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
