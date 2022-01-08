<?php

namespace Tests\Unit;

use App\Model\User;
use App\Model\Story;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoryModelTest extends TestCase
{
    
    use RefreshDatabase;

    /**
     * @var [Story]
     */
    private $story;

    /**
     * @return [Story]
     */
    public function setup()
    {
        parent::setup();

        $this->story = factory(Story::class)->create();
    }

    /**
     * @test
     * @return void
     */
    public function found_story_user()
    {
        $story = $this->story;

        $user = User::find($story->user_id)->first()->lastname;

        $story_user = $story->user->lastname;

        $this->assertEquals($user, $story_user);
    }

}
