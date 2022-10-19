<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        if (!User::find(1)) {
            User::create([
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('123456'),
                'email_verified_at' => now(),
                'role' => 1,
                'remember_token' => Str::random(20),
            ]);
        }
        // User::factory(20)->create();
    }
}
