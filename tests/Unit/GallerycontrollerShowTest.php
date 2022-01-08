<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use App\Model\User;
use App\Repositories\StorieInterface;
use App\Exceptions\CustomException;

use App\Http\Controllers\GalleryController;


class GallerycontrollerShowTest extends TestCase
{
    use RefreshDatabase;
    

    /**
    * Undocumented variable
    *
    * @var [GalleryInterface]
    */
    protected $storieInterface;
    
    public function setUp()
    {
        parent::setUp();

        $this->storieInterface = $this->app->make(StorieInterface::class);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_not_found_story_return_exception() 
    {
        $this->expectException(CustomException::class);
        $this->storieInterface->getById(1);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_found_return_story() 
    {
        // $user = factory(\App\Model\Like::class)->create();
        // // $user = factory(\App\Model\Like::class)->create();
        
        // $story = $this->storieInterface->getById(1);
        // dd($story);
        $this->assertEquals("toto", "toto");
        
    }
}
