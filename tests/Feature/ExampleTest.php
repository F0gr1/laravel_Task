<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home_redirects_guests_to_login()
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_health_endpoint_is_public(): void
    {
        $this->get('/up')
            ->assertOk()
            ->assertJson(['status' => 'ok']);
    }
}
