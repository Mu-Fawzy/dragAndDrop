<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'mohamed fawzy',
            'email' => 'mrrmohamedfawzy@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('00000000'), // password
            'remember_token' => Str::random(10),
        ]);
        $admin->factory(1)->create();
    }
}
