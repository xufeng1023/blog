<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_users_can_access_settings()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	$this->get('/settings');
    }

    public function test_user_can_update_their_account()
    {
    	$data = ['name' => 'name', 'email' => 'email@email.com'];
    	$user = $this->create('User', $data);
    	
    	$data = ['name' => 'name2', 'email' => 'email2@email.com'];
		$this->login($user)->post('/settings/account', $data);
    	$this->assertDatabaseHas('users', $data);
    }

    public function test_create_an_user_instance_without_saving_to_database_b4_join()
    {
        $data = $this->raw('User', ['password' => '123123']);
        $response = $this->postJson('/user/instance', $data);
        $this->assertInstanceOf('App\User', $response->original);
        $this->assertDatabaseMissing('Users', $data);
    }
}
