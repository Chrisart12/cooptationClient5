<?php

namespace Tests\Unit;

use DB;
use App\Model\Like;
use App\Model\Role;
use App\Model\User;
use Tests\TestCase;
use App\Model\Region; 
use App\Model\Responsible; 
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseTransactions;

    /**
     * @var [User]
     */
    private $user;

    /**
     * @return [User]
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     * @return void
     */
    public function not_found_user_return_null()
    {
        $user = User::find(1);

        $this->assertEquals(null, $user);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_return_user_lastname()
    {
        $user = $this->user;

        $user_lastname =  User::find($user->id)->lastname;
        $this->assertEquals($user->lastname, $user_lastname);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_return_user_story()
    {
        // $user = factory(\App\Model\User::class)->create();
        $story = factory(\App\Model\Story::class)->create();

        $user_story = User::find($story->user_id)->story->story;
        $this->assertEquals($story->story, $user_story);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_return_user_region()
    {
        $user = $this->user;
        $region = Region::find($user->region_id)->label;

        $user_region = User::find($user->id)->region->label;
        $this->assertEquals($region, $user_region);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_return_user_responsible()
    {
        $user = $this->user;
        $responsible = Responsible::find($user->responsible_id)->label;

        $user_responsible = User::find($user->id)->responsible->label;

        $this->assertEquals($responsible, $user_responsible);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_return_user_roles()
    {
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"]
        ]);

        $user = $this->user;
        
        // $roles = Role::all();

        foreach (Role::all() as $role) {
            DB::table('role_user')->insert([
                ["user_id" => $user->id, "role_id" => $role->id],
            ]);
        }

        $roles = [];
        foreach (Role::all() as $role) {
            \array_push($roles, $role->label);
        }

        $user_roles = [];
        foreach ($user->roles as $role) {
            \array_push($user_roles, $role->label);
        }
        
        $this->assertEquals($roles, $user_roles);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_hasRole_return_false()
    {
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"]
        ]);
        
        $user = $this->user;

        foreach (Role::all() as $role) {
            DB::table('role_user')->insert([
                ["user_id" => $user->id, "role_id" => $role->id],
            ]);
        }

        $response = $user->hasRole('admi');

        $this->assertEquals(false, $response);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_hasRole_return_true()
    {
       
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"]
        ]);

        $user = $this->user;

        foreach (Role::all() as $role) {
            DB::table('role_user')->insert([
                ["user_id" => $user->id, "role_id" => $role->id],
            ]);
        }

        $response = $user->hasRole('admin');

        $this->assertEquals(true, $response);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_hasAnyRole_return_false()
    {
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"]
        ]);
        
        $user = $this->user;

        foreach (Role::all() as $role) {
            DB::table('role_user')->insert([
                ["user_id" => $user->id, "role_id" => $role->id],
            ]);
        }

        $response = $user->hasRole(['ad', 'super_admin']);

        $this->assertEquals(false, $response);
    }

    /**
     * @test
     * @return void
     */
    public function found_user_hasAnyRole_return_true()
    {
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"]
        ]);
        
        $user = $this->user;

        foreach (Role::all() as $role) {
            DB::table('role_user')->insert([
                ["user_id" => $user->id, "role_id" => $role->id],
            ]);
        }

        $response = $user->hasRole(['admin', 'super_admin']);

        $this->assertEquals(true, $response);
    }

    /**
     * @test
     * @return void
     */
    // public function found_user_likes()
    // {
    //     $story = factory(\App\Model\Story::class)->create();
       
    //     $user = User::find($story->user_id);

    //     DB::table('likes')->insert([
    //         ["user_id" => $user->id, "story_id" => $story->user_id, "created_at" => DB::raw('now()'), "updated_at" => DB::raw('now()')]
    //     ]);

    //     $likes = [];
    //     foreach (Like::all() as $like) {
    //         \array_push($likes, $like->story_id);
    //     }

    //     $user_likes = [];
    //     foreach ($user->likes as $like) {
    //         \array_push($user_likes, $like->user_id);
    //     }

    //     $this->assertEquals($likes, $user_likes);
        
    // }

}
