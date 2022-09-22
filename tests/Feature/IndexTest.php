<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_home_page()
    {
        $response = $this->get('/')
            ->assertStatus(200)
            ->assertSee('Welcome to JS-Ninjify!');
    }
}
