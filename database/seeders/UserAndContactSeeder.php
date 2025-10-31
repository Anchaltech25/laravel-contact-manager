<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserAndContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // create 500 users and contacts
        for ($i = 1; $i <= 500; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'), // same password for all: 'password'
            ]);

            Contact::create([
                'name' => $faker->name,
                'email' => "contact{$i}@example.com",
                'number' => $faker->unique()->numerify('9#########'),
                'bio' => $faker->sentence(12),
                'user_id' => $user->id,
                'is_active' => $faker->boolean(80),
                'profile_image' => null, // or set to a placeholder path if you like
            ]);
        }
    
    }
}
