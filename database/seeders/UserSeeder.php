<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
       User::factory()->create([
        'name' => 'panitia',
        'username' => 'panitia',
        'password' => Hash::make('panitia'),

       ]);

       User::factory()->create([
        'name' => 'vendor',
        'username' => 'vendor',
        'password' => Hash::make('vendor'),
       ]);


    }
}
