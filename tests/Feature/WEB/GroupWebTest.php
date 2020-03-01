<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupWebTest extends TestCase
{
    public function testGroupList()
    {
        $response = $this->actingAs($this->user, 'web')->get('/groups');
        $response->assertStatus(200)
            ->assertViewIs('groups.index')
            ->assertOk();
    }

}

