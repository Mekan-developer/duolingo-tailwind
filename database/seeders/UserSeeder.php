<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'role' => 1,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('secret'),
            'remember_token' => Str::random(10), 
        ]);
    }
}
