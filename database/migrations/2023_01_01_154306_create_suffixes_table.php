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
        Schema::create('suffixes', function (Blueprint $table) {
            $table->id();
            $table->string('suffix');
            $table->string('jpn');
            $table->unsignedBigInteger('parse_id');
            $table->foreign('parse_id')->references('id')->on('parses');
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
        Schema::dropIfExists('suffixes');
    }
};
