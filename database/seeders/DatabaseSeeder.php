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
        $this->call(SportSeeder::class);
        $this->call(SportClubSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RegistrantSeeder::class);
    }
}
