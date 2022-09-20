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
        Schema::create('descriptives', function (Blueprint $table) {
            $table->foreignId('word_id')->references('id')->on('words');
            $table->foreignId('buzzword_id')->references('id')->on('buzzwords');
            $table->primary(['word_id', 'buzzword_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descriptives');
    }
};
