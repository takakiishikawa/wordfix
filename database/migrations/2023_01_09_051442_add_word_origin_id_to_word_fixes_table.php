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
            $table->unsignedBigInteger('word_origin_id')->nullable();
            $table->foreign('word_origin_id')->references('id')->on('word_origins');
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
