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
        Schema::create('comments', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('feedback_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->unsignedBigInteger('parent_id')->nullable(); // Vastaus toiseen kommenttiin
            $table->timestamps();

            $table->foreign('feedback_id')->references('id')->on('feedback')->onDelete('cascade');//tää tuo feedbackistä sen id:n
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
