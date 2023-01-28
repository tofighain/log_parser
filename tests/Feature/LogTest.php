<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_uri()
    {
        $response = $this->get('api/logs/count');

        $response->assertStatus(200);
    }
    public function test_exactly_20_results_on_init()
    {
        $response = $this->get('api/logs/count');
        $response->assertContent("20");
    }
    public function test_versions_return_same_result(){
        $r = $this->get('api/v1/logs/count');
        $r1 = $this->get('api/logs/count');
        $this->assertEquals($r->baseResponse->original, $r1->baseResponse->original);
    }
}
