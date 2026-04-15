<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserAndContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // 👉 Change this number (3 or 5)
        $totalUsers = 5;

        for ($i = 1; $i <= $totalUsers; $i++) {

            // Optional dummy image (or keep null)
            $profileImage = $faker->boolean(70) ? $faker->image('public/profile_images', 400, 400, null, false) : null;
            // Example if you want static image:
            // $profileImage = 'profile_images/default.png';

            $user = User::create([
                'name' => $faker->name,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role_id' => 2, // normal user
                'profile_image' => $profileImage, // ✅ added
            ]);

            Contact::create([
                'name' => $faker->name,
                'email' => "contact{$i}@example.com",
                'number' => $faker->unique()->numerify('9#########'),
                'bio' => $faker->sentence(12),
                'user_id' => $user->id,
                'is_active' => $faker->boolean(80),
                'profile_image' => null, // contact image stays separate
            ]);
        }
    }
}
