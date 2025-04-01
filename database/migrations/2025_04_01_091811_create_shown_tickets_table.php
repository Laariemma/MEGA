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
        Schema::create('shown_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Answer_id");
            $table->timestamps();

            $table->foreign('Answer_id')->references('id')->on('Answer')->onDelete('cascade');//tää tuo Answer-taulusta sen id:n
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shown_tickets');
    }
};
