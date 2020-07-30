<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustumerTest extends TestCase
{
   /** @test */
    public function only_logged_users_can_see_home()
    {
        $response = $this->get('/home')
        ->assertRedirect('/login');
    }
}
