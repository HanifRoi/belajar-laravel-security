<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EcryptionTest extends TestCase
{
    public function testEncryption()
    {
        $value = 'Hanif Roihan';

        $encrypted = Crypt::encryptString($value);
        $decrypted = Crypt::decryptString($encrypted);

        assertEquals($value, $decrypted);
    }
}
