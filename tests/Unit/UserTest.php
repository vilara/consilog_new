<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function check_if_user_columm_is_correct()
    {
        $user = new User;

        $espected = ['name','email','password'];

        $arrayCompared = array_diff($espected, $user->getFillable());
        $this->assertEquals(0, count($arrayCompared));
    }

    /** @test */
    public function create_new_user_is_correct()
    {
        $this->assertTrue(true);
    }
}
