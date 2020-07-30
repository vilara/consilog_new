<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterUserTest extends DuskTestCase
{
    /** @test */
    public function check_if_root_site_is_correct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->assertSee('Entre para iniciar uma nova sessão');
        });
    }

    /** @test */
    public function check_if_route_register_is_correct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->assertSee('Registrar');
        });
    }


     /** @test */
    public function check_if_login_function_is_working()
    {
        $user = new User();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', 'teste@teste.com')
                    ->type('password', 'password')
                    ->press('Entrar')
                    ->assertSee('Senha ou usuário inválido...');
        });
    }

     /** @test */
     public function check_if_register_function_is_working()
     {
        $this->withoutExceptionHandLing();
         $user = new User();
         $this->browse(function ($browser) use ($user) {
             $browser->visit('/register')
                     ->type('email', 'teste@teste.com')
                     ->type('password', '12345678')
                     ->type('password_confirmation', '12345678')
                     ->assertSee('Bem-vindo ao Sistema');
         });
     }
}
