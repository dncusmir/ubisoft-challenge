<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => FakerFactory::create()->name,
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test1234'), // password
            'remember_token' => Str::random(10),
            'points' => 100,
        ]);
        

        factory(User::class, 10)->create();
    }
}
