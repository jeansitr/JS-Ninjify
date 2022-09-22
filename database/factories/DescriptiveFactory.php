<?php

namespace Database\Factories;

use App\Models\Buzzword;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Descriptive>
 */
class DescriptiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'word_id' => Word::factory(),
            'buzzword_id' => Buzzword::factory(),
        ];
    }
}
