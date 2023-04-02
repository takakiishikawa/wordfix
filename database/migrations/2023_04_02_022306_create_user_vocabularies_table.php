<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vocabularies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vocabulary_id')->constrained('vocabularies');
            $table->foreignId('user_level_id')->constrained('user_levels');
            $table->string('question_mode');
            $table->integer('answer_count')->default(0);
            $table->string('correct_progress');
            $table->string('vocabulary_lap')->default('0: Not cleared');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vocabularies');
    }
};
