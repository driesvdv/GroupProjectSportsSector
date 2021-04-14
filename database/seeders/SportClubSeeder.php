<?php

namespace Database\Seeders;

use App\Models\Sportclub;
use Illuminate\Database\Seeder;

class SportClubSeeder extends Seeder
{
    protected $names = ['zwemclub', 'loopclub', 'fietsclub', 'voetbalclub', 'turnclub'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $key => $name)
        {
            Sportclub::create([
                'name' => $name,
                'sport_id' => $key + 1
            ]);
        }
    }
}
