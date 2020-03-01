<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscriptionWebTest extends TestCase
{

    public function testUserList()
    {
        $response = $this->actingAs($this->user, 'web')->get('/my/people');
        $response->assertStatus(200)
            ->assertViewIs('subscriptions.user.myUsers')
            ->assertOk();
    }

    public function testGroupList()
    {
        $response = $this->actingAs($this->user, 'web')->get('/my/groups');
        $response->assertStatus(200)
            ->assertViewIs('subscriptions.user.myGroups')
            ->assertOk();
    }

    public function testInvitationList()
    {
        $response = $this->actingAs($this->user, 'web')->get('/my/invites');
        $response->assertStatus(200)
            ->assertViewIs('subscriptions.user.myInvites')
            ->assertOk();
    }

}
