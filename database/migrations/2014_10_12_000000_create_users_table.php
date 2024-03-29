<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('workplace')->nullable();
            $table->text('position')->nullable();
            $table->text('promotional_code')->nullable();
            $table->json('flag')->nullable()->comment('application feature flags for the dedicated user');
            $table->hasOwner();
            $table->enum('type', ['admin', 'subscriber', 'member'])->nullable();
            $table->timestamp('banned_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
