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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained()->nullable();
            $table->string('word_idiom')->nullable();
            $table->string('definition_en')->nullable();
            $table->string('definition_jp')->nullable();
            $table->integer('frequency')->nullable();
            $table->string('parse')->nullable();
            $table->string('pronunciation')->nullable();
            $table->string('word_root')->nullable();
            $table->string('usage_notes')->nullable();
            $table->string('prefix_en')->nullable();
            $table->string('prefix_jp')->nullable();
            $table->string('suffix_en')->nullable();
            $table->string('suffix_jp')->nullable();
            $table->string('suffix_parse')->nullable();
            $table->string('image')->nullable();
            $table->string('main_example_sentence')->nullable();
            $table->string('extra_example_sentences')->nullable();
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
        Schema::dropIfExists('vocabularies');
    }
};
