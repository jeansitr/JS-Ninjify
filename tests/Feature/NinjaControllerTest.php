<?php

namespace Tests\Feature;

use App\Models\Buzzword;
use App\Models\Descriptive;
use App\Models\Word;
use Tests\TestCase;

class NinjaControllerTest extends TestCase
{
    /**
     * @test
     */
    public function returns_an_error_if_buzzwords_are_missing_from_the_request()
    {
        $this->get('/api/ninjify')
            ->assertExactJson(['error' => 'Missing Buzzwords.']);
    }

    /** @test */
    public function returns_an_error_if_not_enough_buzzwords()
    {
        $this->get('/api/ninjify?x=patate')
            ->assertExactJson(['error' => 'Buzzwords not found.']);
    }

    /** @test */
    public function returns_a_ninja_name_based_on_provided_buzzwords()
    {
        $buzzword = Buzzword::factory()->create();
        $words = Word::factory()->count(5)->create();
        foreach ($words as $word) {
            Descriptive::factory()->create(['word_id' => $word->id, 'buzzword_id' => $buzzword->id]);
        }

        $response = $this->get('/api/ninjify?x='.$buzzword->buzzword);

        $this->assertNotEmpty($response['ninjaname']);

        $terms = explode(' ', $response['ninjaname']);

        foreach ($terms as $term) {
            $this->assertTrue(
                in_array(
                    $term,
                    $words->pluck('word')->toArray()
                )
            );
        }
    }
}
