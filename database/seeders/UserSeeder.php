<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 99; $i++) {
            User::create([
                'username' => Str::random(10),
                'email' => $faker->email,
                'password' => Hash::make('12345678'),
                'role' => 'normal',
                'address' => $faker->address
            ]);
        }
    }
}
