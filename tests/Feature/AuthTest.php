<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomeNotAuth()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    public function testHomeAuth()
    {
        $this->setAuthUser();
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function testGetLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testGetRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testPostRegisterFail()
    {
        $response = $this->post('/register');

        $response->assertStatus(302);
    }

    public function testPostRegisterSuccess()
    {
        $param = [
            'name' => 'name',
            'email' => 'email12345678@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];
        // $this->post('/logout');

        $response = $this->post('/register', $param);

        $response->assertStatus(302);
    }

    public function testGetResetPassword()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    public function testPostResetPassword()
    {
        $user = $this->setAuthUser();

        $response = $this->post('/password/reset', ['email' => $user->email]);
        $response->assertStatus(302);

        $this->post('/logout');
        $response = $this->post('/password/reset', ['email' => $user->email]);
        $response->assertStatus(302);
    }
}
