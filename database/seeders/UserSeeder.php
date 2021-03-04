<?php

namespace Database\Seeders;

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
        //
        User::create([
            'name' => 'José Luis GutyLabs',
            'email' => 'admin@blog.test',
            'password' => bcrypt('password')
        ]);

        User::factory(9)->create();
    }
}
