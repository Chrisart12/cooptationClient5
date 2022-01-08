<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GallerycontrollerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function gallery_page_return_filter()
    {
        $response = $this->get('/gallery')
        ->assertRedirect('/login');
        // $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function authenticated_users_can_see_the_gallery()
    {
        $this->actingAs(factory(\App\Model\User::class)->create());

        $response = $this->get('/gallery');
        $response->assertStatus(200);
    }
}
