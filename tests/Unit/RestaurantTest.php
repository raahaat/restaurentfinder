<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RestaurantTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRestaurantCreateFormDisplayed()
    {
        $user = factory(User::class)->make([
            'id'=>1,
            'is_admin'=>1,
            'name' => "jashem",
            'email' => "mjashem@yahoo.com",
        ]);
        $response = $this->actingAs($user)->get('/admin/restaurants/create');
        $response->assertSuccessful();
        $response->assertViewIs('restaurants.create');
    }

    public function testRestaurantCreateFormNotDisplayed()
    {
        $user = factory(User::class)->make([
            'id'=>2,
            'is_admin'=>0,
            'name' => "mofij",
            'email' => "mofij@yahoo.com",
        ]);
        $response = $this->actingAs($user)->get('/admin/restaurants/create');
        $response->assertSessionHas('warning');
        $response->assertRedirect('/');
    }

    public function testValidRestaurantCreate()
    {
        // $restaurant = factory(Restaurant::class)->make([
        //     'name'=> 'abul hotel',
        //     'address' => '16, 1 Malibagh Chowdhury Para Rd, Dhaka 1219',
        //     'contact' => '12345678910',
        // ]);

        
        $response = $this->post('restaurants.store',[
            'name'=> 'abul hotel',
            'address' => '16, 1 Malibagh Chowdhury Para Rd, Dhaka 1219',
            'contact' => '123456789',
        ]);
        $response->assertSessionHas('success');
        $response->assertRedirect('/');
    }
}
