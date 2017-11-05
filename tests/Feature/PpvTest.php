<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PpvTest extends TestCase
{
	use RefreshDatabase;

	public function test_guests_can_not_add_ppv()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');
		$this->post("/ppv/1/1");
	}

	public function test_auth_user_can_add_ppv()
	{
		$post = $this->create('Post');
		$user = $this->create('User');
		$this->login($user)->post("/ppv/{$user->id}/{$post->slug}");
		$this->assertDatabaseHas('ppvs', ['user_id'=>$user->id,'post_id'=>$post->id]);
	}
}
