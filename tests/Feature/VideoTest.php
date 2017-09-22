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
    	$this->get('/video/slug-not-exists');
    }
}
