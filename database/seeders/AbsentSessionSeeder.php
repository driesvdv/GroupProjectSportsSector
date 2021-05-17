<?php

namespace Database\Seeders;

use App\Models\AbsentSession;
use App\Models\Registration;
use App\Models\SportSession;
use Illuminate\Database\Seeder;

class AbsentSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0, 25) as $i) {
            AbsentSession::create([
                'registration_id' => Registration::inRandomOrder()->first()->id,
                'sport_session_id' => SportSession::inRandomOrder()->first()->id,
            ]);
        }

    }
}
