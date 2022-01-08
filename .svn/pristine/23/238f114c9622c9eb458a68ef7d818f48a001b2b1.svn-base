<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function should_return_formate_date()
    {
        $this->assertEquals("06/12/2020 à 18:27:40", formateDateTime("2020-12-06 18:27:40"));
    }

    /**
     * @test
     */
    public function should_return_formate_short_date()
    {
        $this->assertEquals("06/12/2020", formatShortDateTime("2020-12-06"));
    }

    /**
     * @test
     */
    // public function should_return_active_class()
    // {
        
    //     $this->assertEquals("active", add_active_route_class("jobs"));
    // }

    
}

