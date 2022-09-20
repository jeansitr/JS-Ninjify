<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->primary(['word_id', 'buzzword_id']);
            $table->foreignId('word_id')->references('id')->on('words');
            $table->foreignId('buzzword_id')->references('id')->on('buzzwords');
        });

        $wordCnt = DB::table('words')->count();
        $buzzCnt = DB::table('buzzwords')->count();

        $descriptive = [];
        for ($i = 1; $i < $buzzCnt + 1; $i++) {
            $chosen = [];
            for ($e = 1; $e < 6; $e++) {
                $wordID = rand(1, $wordCnt);

                //ensure no duplicate entries
                while (in_array($wordID, $chosen)) {
                    $wordID = rand(1, $wordCnt);
                }

                $descriptive[] = ['word_id' => $wordID, 'buzzword_id' => $i];
                $chosen[] = $wordID;
            }
        }

        DB::table('descriptives')->insert($descriptive);
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
