<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserWebTest extends TestCase
{
    public function testUserList()
    {
        $response = $this->actingAs($this->user, 'web')->get('/users');
        $response->assertStatus(200)
            ->assertViewIs('users.index')
            ->assertOk();
    }

}
