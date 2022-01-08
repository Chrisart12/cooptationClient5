<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\Candidat;
use App\Model\User;

class CooptationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_user_can_visit_acooptation_page_and_see_candidats()
    {
        $this->actingAs(factory(User::class)->create());

        // $cooptation = factory(Candidat::class)->create();
        $response = $this->get('/cooptation');
        // $response->assertSee($cooptation->lastname);
        // $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
