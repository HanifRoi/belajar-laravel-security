<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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
}
