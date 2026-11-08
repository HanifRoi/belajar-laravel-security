<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class HashTest extends TestCase
{
    public function testHash()
    {
        $password = 'rahasia';
        $hash = Hash::make($password);

        $password2 = 'rahasia';
        $hash2 = Hash::make($password2);

        assertEquals($password2, $password);
        assertTrue(Hash::check($password, $hash));
        assertTrue(Hash::check($password2, $hash2));
    }
}
