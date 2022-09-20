<?php

use App\Models\Buzzword;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ninjify', function () {
    $buzzwords = request('x');

    if ($buzzwords) {
        $buzzwords = explode(',', $buzzwords);

        $buzzwords = Buzzword::with("words")->whereIn('buzzword', $buzzwords)->get();

        $descriptives = collect([]);

        //TODO: Change this, Cleary an N+1 error
        foreach ($buzzwords as $buzzword) {
            $descriptives->add($buzzword->words->map(fn ($word) => $word->word));
        }

        $descriptives = $descriptives->flatten()->unique();

        $descriptivesCnt = count($descriptives);
        if ($descriptivesCnt > 4) {
            $ninjaName = '';

            //select up to 4 words for ninja name
            $nameCnt = rand(1, 4);
            for ($i = 0; $i < $nameCnt; $i++) {
                $descriptivesCnt--;

                $chosenIndx = rand(0, $descriptivesCnt);

                $ninjaName .= $descriptives[$chosenIndx].' ';
                $descriptives->pull($descriptives[$chosenIndx]);
            }

            $ninjaName = Str::squish($ninjaName);
        }

        return ['ninjaname' => $ninjaName];
    }
});
