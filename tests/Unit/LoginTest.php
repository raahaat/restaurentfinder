<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginFormDisplayed()
    {

        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testLoginValidUser()
    {
        $user = factory(User::class)->make([
            'id'=>1,
            'email' => "mjashem@yahoo.com",
            'password' => '123456'
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testLoginInvalidUser()
    {
        $user = factory(User::class)->make([
            'email' => "mjashem@hoo.com",
            'password' => '123456'
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function testLogoutAuthenticatedUser()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/logout');
        $this->assertGuest();
    }

}
