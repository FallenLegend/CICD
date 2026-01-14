<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The home page should return 200 and contain the app name from config.
     */
    public function test_home_page_shows_app_name()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(config('app.name'));
    }
}
