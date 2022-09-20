<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Buzzword;
use Illuminate\Support\Str;

class NinjifyController extends Controller
{
    /**
     * Get ninja name or give back error
     *
     * @return string[]
     */
    public function GetNinjaNameOrFail()
    {
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

            $descCnt = $descriptives->count();
            if ($descCnt > 4) {
                $ninjaName = '';

                //select up to 4 words for ninja name
                $nameCnt = rand(1, 4);

                for ($i = 0; $i < $nameCnt; $i++) {
                    $descCnt--;
                    $chosen = $descriptives->pull(rand(0, $descCnt));
                    $ninjaName .= $chosen.' ';
                }

                $ninjaName = Str::squish($ninjaName);
            } else {
                return ['error' => 'Buzzwords not found.'];
            }

            return ['ninjaname' => $ninjaName];
        } else {
            return ['error' => 'Missing Buzzwords.'];
        }
    }
}
