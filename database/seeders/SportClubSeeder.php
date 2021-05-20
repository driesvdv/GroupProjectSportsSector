<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Sportclub;
use App\Models\SportSession;
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
            $sportClub = Sportclub::create([
                'name' => $name,
                'sport_id' => $key + 1
            ]);

            Group::factory()
                ->count(10)
                ->for($sportClub)
                ->has(SportSession::factory()->count(6))
                ->create();
        }
    }
}
