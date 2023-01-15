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
        Schema::table('word_fixes', function (Blueprint $table) {
            $table->unsignedBigInteger('root_id')->nullable();
            $table->foreign('root_id')->references('id')->on('roots');
            $table->unsignedBigInteger('suffix_id')->nullable();;
            $table->foreign('suffix_id')->references('id')->on('suffixes');
            $table->unsignedBigInteger('prefix_id')->nullable();;
            $table->foreign('prefix_id')->references('id')->on('prefixes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('word_fixes', function (Blueprint $table) {
            //
        });
    }
};
