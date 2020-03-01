<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{

    public function testMyGroupApi()
    {
        $response = $this->actingAs($this->user, 'api')->getJson('/api/subscriber/my-invites');
        $response->assertStatus(200);//ok
    }

    public function testMyGroupApiUnauthorizedRedirectToLogin()
    {
        $response = $this->getJson('/api/subscriber/my-invites');
        $response->assertStatus(401); //unauthorized
    }

    /********************    Invitations  *******************/
    public function testInviteUserToGroup()
    {
        $group = Group::all()->random();
        $user = User::all()->random();
        $params = ["groupId" => $group->id, "userId" => $user->id];
        $response = $this->actingAs($this->user, 'api')->postJson('/api/subscriber/invite', $params);
        $response->assertStatus(201);//created
    }

    public function testInviteUserUnauthorizedRedirectToLogin()
    {
        $group = Group::all()->random();
        $user = User::all()->random();
        $params = ["groupId" => $group->id, "userId" => $user->id];
        $response = $this->postJson('/api/subscriber/invite', $params);
        $response->assertStatus(401);//unauthorized
    }

}
