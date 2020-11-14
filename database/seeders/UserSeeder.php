<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'role' => 'super_admin',
            'password' => bcrypt('123456'),

        ]);


        foreach (City::cursor() as $city) {
            User::factory()->create([
                'name' => 'Admin for ' . $city->name,
                'email' => str_replace(' ', '', strtolower($city->name)).'@admin.com',
                'city_id' => $city->id,
                'password' => bcrypt('123456'),
            ]);
        }


    }
}
