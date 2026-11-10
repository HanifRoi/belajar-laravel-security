<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Hanif Roihan',
            'email'=>'hanif@gans',
            'password'=>Hash::make('rahasia'),
            'token'=> 'secret'
        ]);

        User::create([
            'name'=>'Hanif Roihan',
            'email'=>'roihan@gans',
            'password'=>Hash::make('rahasia'),
            'token'=> 'secret'
        ]);
    }
}
