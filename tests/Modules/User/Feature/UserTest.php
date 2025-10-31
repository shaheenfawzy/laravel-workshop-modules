<?php

namespace Tests\Modules\User\Feature;

use Modules\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_user_creation(): void
    {
        User::factory()->create();
    }
}
