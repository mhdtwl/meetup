<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{

    /********************    API/ Login  *******************/
    public function testUserApiLogin()
    {
        $params = ["email" => "john@meetup.net", "password" => "password"];
        $response = $this->postJson('/api/login', $params);
        $response->assertStatus(200)->assertOk();
        $this->assertEquals($this->user->toArray(), $response["user"]);
        $this->assertArrayHasKey("access-token", $response);
    }

    public function testUserApiLoginFailed()
    {
        $params = ["email" => "john@meetup.net", "password" => "password111"];
        $response = $this->postJson('/api/login', $params);
        $response->assertStatus(401)
            ->assertUnauthorized();

        $this->assertArrayHasKey("message", $response);
    }


    /********************    API/ User   *******************/
    public function testApiUserListSearch()
    {
        $john = $this->user;
        $response = $this->getJson('/api/users?search=john@meetup.net');
        $response->assertStatus(200)
            ->assertOk();

        $this->assertEquals($response['data']['data'][0]['email'], $john->email);
    }

    public function testApiUserListLength()
    {
        $response = $this->actingAs($this->user, 'web')
            ->getJson("/api/users?length=10");
        $response->assertStatus(200)
            ->assertOk();

        $this->assertEquals($response['data']["per_page"], 10);
    }


}
