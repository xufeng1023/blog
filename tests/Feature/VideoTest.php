<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guests_can_see_video_prviews()
    {
        $video = $this->create('Video', ['is_free' => 1]);
        $this->deleteUselessFile($video->link);
        $this->get('/video/'.$video->slug)->assertStatus(200);
    }

    public function test_guests_can_not_see_paid_videos()
    {
        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);
        $this->get('/video/'.$video->slug)->assertStatus(404);
    }

    public function test_expired_members_can_not_see_paid_videos()
    {
        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);

        $user = $this->create('User');

        $sub = $this->create('Subscription', [
            'user_id' => $user->id, 
            'name' => 'main',
            'ends_at' => Carbon::now()->subday()
        ]);

        $this->login($user)->get('/video/'.$video->slug)->assertStatus(404);
    }

    public function test_new_members_can_see_paid_videos()
    {
        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);

        $user = $this->create('User');

        $sub = $this->create('Subscription', ['user_id' => $user->id, 'name' => 'main']);
        
        $this->login($user)->get('/video/'.$video->slug)->assertStatus(200);
    }

    public function test_return_not_found_if_video_not_exists()
    {
        $this->expectException('Illuminate\Database\Eloquent\ModelNotFoundException');
    	$this->get('/video/slug-not-exists/checkSlug');
    }

    public function test_free_videos_will_play()
    {
        $video = $this->create('Video', ['is_free' => 1]);
        $this->deleteUselessFile($video->link);
        $this->get('/video/'.$video->slug.'/checkSlug')
            ->assertSee($video->slug);
    }

    public function test_video_check_will_block_guests_for_paid_videos()
    {
        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);
        $this->get('/video/'.$video->slug.'/checkSlug')
            ->assertStatus(401);
    }

    public function test_video_check_will_block_unsubscribed_users_for_paid_videos()
    {
        $user = $this->create('User');
        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);
        $this->login($user)->get('/video/'.$video->slug.'/checkSlug')
            ->assertStatus(402);
    }

    public function test_video_check_will_block_expired_users_for_paid_videos()
    {
        $user = $this->create('User');

        $this->create('Subscription', [
            'user_id' => $user->id,
            'name' => 'main',
            'ends_at' => Carbon::now()->subweek()
        ]);

        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);

        $this->login($user)->get('/video/'.$video->slug.'/checkSlug')
            ->assertStatus(402);
    }

    public function test_subscribed_users_will_pass_video_check_for_paid_videos()
    {
        $user = $this->create('User');

        $this->create('Subscription', [
            'user_id' => $user->id,
            'name' => 'main'
        ]);

        $video = $this->create('Video');
        $this->deleteUselessFile($video->link);

        $this->login($user)->get('/video/'.$video->slug.'/checkSlug')
            ->assertSee($video->slug);
    }
}
