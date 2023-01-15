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
        Schema::create('word_fixes', function (Blueprint $table) {
            $table->id();
            $table->string('eng');
            $table->string('jpn1');
            $table->string('jpn2')->nullable();
            $table->string('jpn3')->nullable();
            $table->integer('correctCount');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedBigInteger('parse_id');
            $table->foreign('parse_id')->references('id')->on('parses');
            $table->unsignedBigInteger('fix_id');
            $table->foreign('fix_id')->references('id')->on('fixes');
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
        Schema::dropIfExists('word_fixes');
    }
};
