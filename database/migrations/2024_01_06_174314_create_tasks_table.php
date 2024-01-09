<?php

use App\Models\ProductCategory;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('name');
            $table->enum('category', ['one', 'two', 'three']);
            $table->enum('status', ['high', 'low']);
            $table->boolean('choose_mvp');
            $table->longText('details');
            $table->longText('steps');
            $table->dateTime('starting_date');
            $table->dateTime('ending_date');
            $table->string('administrator');
            $table->string('add_attachments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};