<?php

namespace Tests;

<<<<<<< HEAD
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setAuthUser(array $attributes = [])
    {
        $user = factory(User::class)->create($attributes);
        $this->actingAs($user, 'web');

        return $user;
    }
}
