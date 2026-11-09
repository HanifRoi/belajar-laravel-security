<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

class UserTest extends TestCase
{
    public function testAuthentication()
    {
        $this->seed(UserSeeder::class);
        $response = Auth::attempt([//mencoba login
            'email'=>'hanif@gans',
            'password'=>'rahasia'
        ],true);
        assertTrue($response);

        $user = Auth::user();//mengambil user
        assertNotNull($user);
        assertEquals('hanif@gans', $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        assertNull($user);
    }

    public function testLogin()
    {
        $this->seed(UserSeeder::class);

        $this->get('users/login?email=hanif@gans&password=rahasia')
        ->assertRedirect('users/current');

        $this->get('users/login?email=hanif@gans&password=wrong')
        ->assertSeeText('Wrong credentials');
    }

    public function testCurrent()
    {
       $this->seed(UserSeeder::class);

        $user = User::where('email', 'hanif@gans')->first();
        $this->actingAs($user);

        $response = $this->get('users/current')
        ->assertSeeText('Hello Hanif Roihan');
    }

    public function testCurrentBeforeLogin()
    {
        $this->seed(UserSeeder::class);
        $this->get('users/current')->assertRedirect('/login')->assertStatus(302);
    }

    public function testCurrentAfterLogin()
    {
        $this->seed(UserSeeder::class);
        $user = User::where('email', 'hanif@gans')->first();
        $this->actingAs($user);
        $this->get('users/current')->assertStatus(200)->assertSeeText('Hello Hanif Roihan');
    }

    public function testTokenGuard()
    {
        $this->seed(UserSeeder::class);
        
        $this->get('/api/users/current', [
            'Accept'=>'application/json'
        ])->assertStatus(401);

        $this->get('/api/users/current', [
            'API-Key'=>'secret'
        ])->assertSeeText('Hello Hanif Roihan');
    }

    public function testUserProvider()
    {
        $this->seed(UserSeeder::class);
        
        
        $this->get('/simple-api/users/current', [
            'Accept'=>'application/json'
        ])->assertStatus(401);

        $this->get('/simple-api/users/current', [
            'API-Key'=>'secret'
        ])->assertSeeText('Hello Hanif Roihan');
    }
}
