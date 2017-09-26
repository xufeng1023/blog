<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StripeTest extends TestCase
{
	use DatabaseMigrations;

    public function test_on_register_page_guests_can_see_plans()
    {
    	$plan = $this->create('Plan');
        $this->get('/plans')->assertSee($plan->name);
    }
}
