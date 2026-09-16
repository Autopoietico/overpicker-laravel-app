<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_sources_redirects_permanently_to_about(): void
    {
        $response = $this->get('/sources');

        $response->assertStatus(301);
        $response->assertRedirect('/about');
    }
}
