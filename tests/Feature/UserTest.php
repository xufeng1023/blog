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
    	$data = ['email' => 'email@email.com'];
    	$user = $this->create('User', $data);
    	
    	$data = ['email' => 'email2@email.com'];
		$this->login($user)->post('/settings/account', $data);
    	$this->assertDatabaseHas('users', $data);
    }
}
