<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testRegistersValidUser()
    {
        $user = factory(User::class)->make([
            'name' => "mofij",
            'email' => "mofij@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function testRegisterInvalidUserWithWrongPassword()
    {
        $user = factory(User::class)->make([
            'name' => "mokhlace",
            'email' => "mokhlace@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function testRegisterInvalidUserWithSameEmail()
    {
        $user = factory(User::class)->make([
            'name' => "mokhlace",
            'email' => "mofij@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    
    public function testRegisterInvalidUserWithSmallPassword()
    {
        $user = factory(User::class)->make([
            'name' => "mokhlace",
            'email' => "mofij@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secr',
            'password_confirmation' => 'secr'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

}
