<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTestModel extends TestCase
{
     /** @test */
     public function a_response_new_user_is_working()
     {
        $response = $this->json('POST', '/usuarios');

        $response->assertStatus(200);
            // ->assertJsonPath('team.owner.name', 'foo')

        // $response->assertSuccessful();

     }

       /** @test */
       public function a_create_new_user_is_working()
       {
         $this->withoutExceptionHandling();

        $response = $this->post('usuarios', [
            'name' => 'vilara',
            'email' => 'marcelovilara@gmail.com',
            'password' => '12345678',

        ]);
            dd($response);
        $response->assertOk();
        // $this->assertCount(1, User::all());

       }



}
