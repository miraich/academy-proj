<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_home_page_status(): void
    {
        $response = $this->get(route('main'));

        $response->assertStatus(200);
        $response->assertViewIs('layouts.main');
    }
}
