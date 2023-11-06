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
    Schema::create('activities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable();
        $table->string('name')->nullable();
        $table->text('detail')->nullable();
        $table->text('goal')->nullable();
        $table->string('location')->nullable();
        $table->integer('maximum')->nullable();
        $table->string('post_image_path')->nullable();
        $table->dateTime('start_date')->nullable();
        $table->dateTime('end_date')->nullable();
        $table->dateTime('create_date');
        $table->dateTime('delete_date')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
