<?php

use App\Models\Buzzword;
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
        $descriptives = collect([]);

        //Get Buzzwords
        $buzzwords = explode(',', $buzzwords);
        $buzzwords = Buzzword::with('words')->whereIn('buzzword', $buzzwords)->get();

        foreach ($buzzwords as $buzzword) {
            $descriptives->add($buzzword->words->map(fn ($word) => $word->word));
        }

        //put in a single array and only keeps unique ones
        $descriptives = $descriptives->flatten()->unique();

        if (count($descriptives) > 4) {
            $ninjaName = '';

            //select up to 4 words for ninja name
            $nameCnt = rand(1, 4);

            for ($i = 0; $i < $nameCnt; $i++) {
                $chosen = $descriptives->random(1)[0];
                $ninjaName .= $chosen.' ';
                $descriptives->pull($chosen);
            }

            $ninjaName = Str::squish($ninjaName);
        } else {
            return ['error' => 'Buzzwords not found.'];
        }

        return ['ninjaname' => $ninjaName];
    } else {
        return ['error' => 'Missing Buzzwords.'];
    }
});
