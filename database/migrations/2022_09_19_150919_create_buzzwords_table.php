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
        Schema::create('buzzwords', function (Blueprint $table) {
            $table->id();
            $table->string('buzzword', 30)->unique()->nullable(false);
        });

        $rawBuzzwords = file_get_contents(resource_path().'/json/buzzwords.json');
        $buzzwords = json_decode($rawBuzzwords, true)['buzzwords'];

        DB::table('buzzwords')->insert($buzzwords);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buzzwords');
    }
};
