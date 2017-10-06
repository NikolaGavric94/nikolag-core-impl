<?php

namespace Nikolag\Myservice\Tests\Unit;

use Nikolag\Myservice\Tests\Models\User;
use Nikolag\Myservice\Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * User creation
     *
     * @return void
     */
    public function test_user_make()
    {
        $user = factory(User::class)->make();

        $this->assertTrue($user!=null, 'User is null');
    }
}
