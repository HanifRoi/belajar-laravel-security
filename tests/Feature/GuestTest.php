<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class GuestTest extends TestCase
{
    public function testRegristationGuest()
    {
        assertTrue(Gate::allows('create', User::class));
    }

    public function testRegristationLogin()
    {
        $this->seed(UserSeeder::class);
        $user = User::where('email', 'hanif@gans')->firstOrFail();
        $this->actingAs($user);
        assertFalse(Gate::allows('create', User::class));
    }
}
