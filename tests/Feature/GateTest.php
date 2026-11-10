<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Database\Seeders\ContactSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class GateTest extends TestCase
{
    public function testGate()
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user = User::where('email', 'hanif@gans')->first();

        $this->actingAs($user);
        $contact = Contact::where('email', 'test@gans')->first();
        assertTrue(Gate::allows('get-contact', $contact));
        assertTrue(Gate::allows('update-contact', $contact));
        assertTrue(Gate::allows('delete-contact', $contact));
    }

    public function testGateNotAllows() {
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user  = User::where('email', 'roihan@gans')->firstOrFail();
        $this->actingAs($user);

        $contact = Contact::where('email', 'test@gans')->firstOrFail();
        assertFalse(Gate::allows('get-contact', $contact));
        assertFalse(Gate::allows('update-contact', $contact));
        assertFalse(Gate::allows('delete-contact', $contact));

    }
}
