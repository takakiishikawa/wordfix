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
        Schema::table('word_origins', function (Blueprint $table) {
            $table->unsignedBigInteger('root_id')->nullable();
            $table->foreign('root_id')->references('id')->on('roots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('word_origins', function (Blueprint $table) {
            //
        });
    }
};
