<?php

namespace Tests;

use App\Models\User;

abstract class AbstractTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function generateUser()
    {
        return User::factory()->create();
    }
}
