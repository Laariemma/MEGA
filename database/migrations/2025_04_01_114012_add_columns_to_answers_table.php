<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('answers', 'feedback_id')) {
                $table->foreignId('feedback_id')->constrained()->onDelete('cascade');
            }
    
            if (!Schema::hasColumn('answers', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
    
            if (!Schema::hasColumn('answers', 'answer')) {
                $table->text('answer');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('feedback_id');
            $table->dropColumn('user_id');
            $table->dropColumn('answer');
        });
    }
}
