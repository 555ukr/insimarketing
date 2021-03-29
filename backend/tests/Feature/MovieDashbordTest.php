<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieDashbordTest extends TestCase
{
    /** @test */
    public function test_validate_get_request_error()
    {
        $response = $this->get('/api/movie?rating=error');

        $response->assertStatus(400)
                ->assertJson([
                    "rating" => ["The rating must be a number."]
                ]);
    }

    /** @test */
    public function test_valid_get_request_error()
    {
        $response = $this->get('/api/movie?rating=5.6');

        $response->assertStatus(200);
    }
}
