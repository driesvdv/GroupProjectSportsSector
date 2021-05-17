<?php

namespace Database\Seeders;

use App\Models\Registrant;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Registrant::factory()
            ->has(Registration::factory(3)->count(3))
            ->count(10)
            ->create();
    }
}
