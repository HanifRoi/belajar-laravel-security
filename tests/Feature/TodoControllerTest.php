<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Database\Factories\UserFactory;
use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    public function testTodo()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $this->post('api/todo')->assertStatus(403);

        $user = User::where('email', 'hanif@gans')->firstOrFail();
        $this->actingAs($user);
        $this->post('/api/todo')->assertStatus(200);
    }

    public function testView()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::where('email', 'hanif@gans')->firstOrFail();
        $this->actingAs($user);

        $todos = Todo::get();
        $this->view('todo', [
            'todos'=>$todos
        ])->assertSeeText('Edit')->assertDontSeeText('No edit')->assertSeeText('Delete');
    }

    public function testViewGuest()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::where('email', 'hanif@gans')->firstOrFail();

        $todos = Todo::get();
        $this->view('todo', [
            'todos'=>$todos
        ])->assertSeeText('No edit')->assertDontSeeText('Edit')->assertSeeText('No delete');
    }
}
