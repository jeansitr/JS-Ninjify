<?php

use App\Models\Buzzword;
use App\Models\Descriptive;
use App\Models\Word;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('populateDB', function () {
    $start = now();

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Descriptive::truncate();
    Word::truncate();
    Buzzword::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $rawWords = file_get_contents(resource_path().'/json/words.json');
    $words = json_decode($rawWords, true)['words'];

    Word::insert($words);

    $rawBuzzwords = file_get_contents(resource_path().'/json/buzzwords.json');
    $buzzwords = json_decode($rawBuzzwords, true)['buzzwords'];

    Buzzword::insert($buzzwords);

    $wordCnt = Word::count();
    $buzzCnt = Buzzword::count();

    $descriptive = collect([]);
    for ($i = 1; $i < $buzzCnt + 1; $i++) {
        $previous = collect([]);

        for ($e = 1; $e < 6; $e++) {
            $wordID = rand(1, $wordCnt);

            while ($previous->contains($wordID)) {
                $wordID = rand(1, $wordCnt);
            }

            $descriptive->push(['word_id' => $wordID, 'buzzword_id' => $i]);
            $previous->push($wordID);
        }
    }

    Descriptive::insert($descriptive->toArray());

    $time = $start->diffInMilliseconds(now());
    $this->comment('DB Populated!');
    $this->comment("Executed in $time miliseconds.");
})->purpose('Initialize Database Data');
