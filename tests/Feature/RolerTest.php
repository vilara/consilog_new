<?php

namespace Tests\Feature;

use App\Roler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolerTest extends TestCase
{



   /** @test */
    public function a_roler_can_be_add_is_working()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('rolers', [
            'name' => 'Usuário',
            'label' => 'Permissão de leitura de dados',
        ]);

        $response->assertOk();
        $this->assertCount(1, Roler::all());
    }

    /** @test */
    public function a_roler_label_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('rolers', [
            'name' => 'Usuário',
            'label' => '',
        ]);

        $response->assertSessionHasErrors('label');
    }

     /** @test */
     public function a_roler_name_is_required()
     {
         // $this->withoutExceptionHandling();

         $response = $this->post('rolers', [
             'name' => '',
             'label' => 'Permissão de leitura de dados',
         ]);

         $response->assertSessionHasErrors('name');
     }

     /** @test */
     public function a_roler_can_be_updated()
     {
         // $this->withoutExceptionHandling();

         $this->post('rolers', [
             'name' => 'Usuário',
             'label' => 'Permissão de leitura de dados',
         ]);

         $roler = Roler::first();


         $this->patch('rolers/'. $roler->id, [
            'name' => 'Novo Usuário',
            'label' => 'Novo Permissão de leitura de dados',
         ]);

         $this->assertEquals('Novo Usuário', Roler::first()->name);
         $this->assertEquals('Novo Permissão de leitura de dados', Roler::first()->label);
     }




}
