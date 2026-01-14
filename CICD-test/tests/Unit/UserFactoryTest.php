<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserFactoryTest extends TestCase
{
    /**
     * Ensure the User factory can create a non-persisted instance with expected attributes.
     */
    public function test_user_factory_makes_user_instance(): void
    {
        $user = User::factory()->make();

        $this->assertInstanceOf(User::class, $user);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->email);
    }
}
