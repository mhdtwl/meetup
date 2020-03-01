<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{

    public function testMyGroupApi()
    {
        $response = $this->actingAs($this->user, 'api')->get('/api/subscriber/my-groups');
        $response->assertStatus(200);
    }

    public function testMyGroupApiUnauthorizedRedirectToLogin()
    {
        $response = $this->get('/api/subscriber/my-groups');
        // there's redirect() //assertStatus(401)
        $response->assertStatus(302);
    }
}

