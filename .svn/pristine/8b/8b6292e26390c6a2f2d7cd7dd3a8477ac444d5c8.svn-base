<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * @test
     */
    public function only_logged_in_users_can_see_the_gallery()
    {
        $response = $this->get('/gallery')
                    ->assertRedirect('/login');
        // $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function only_logged_in_users_can_see_the_top30()
    {
        $response = $this->get('/top30')
                    ->assertRedirect('/login');
        // $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function only_logged_in_users_can_see_the_jobs()
    {
        $response = $this->get('/jobs')
                    ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function only_logged_in_users_can_see_the_cooptation()
    {
        $response = $this->get('/cooptation')
                    ->assertRedirect('/login');
    }

    
}
