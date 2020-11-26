<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
//         \App\Models\User::factory(10)->create();
=======
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // \App\Models\User::factory(10)->create();
>>>>>>> 8480ddbdbdeed70a5cc1b64bcff8e6fd2ff70895
    }
}
