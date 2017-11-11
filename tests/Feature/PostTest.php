<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
	use DatabaseMigrations;

    function test_guest_can_see_posts_list_with_thumbnails_at_movies_page()
    {
        $post = $this->create('Post');
        $image1 = $this->create('Image', ['post_id' => $post->id]);
        $image2 = $this->create('Image', ['post_id' => $post->id, 'is_thumbnail' => 1]);
        $this->deleteUselessFile($image1->slug);
        $this->deleteUselessFile($image2->slug);
        $this->get('/movies')
            ->assertSee($post->title)
            ->assertSee($image2->slug)
            ->assertDontSee($image1->slug);
    }

    function test_guest_can_see_post_title_on_a_single_post_page()
    {
        $post = $this->create('Post');

        $this->get('/movie/'.$post->slug)->assertSee($post->title);
    }

    function test_post_title_must_be_unique()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
    	$post = $this->create('Post');
    	$this->login()->post('/admin/posts', ['title' => $post->title])
    		->assertSessionHasErrors('title');
    }

    function test_post_views_update()
    {
        $post = $this->create('Post');

        $this->post('/post/'.$post->slug.'/updateViews');
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'views' => 1]);
    }
}
