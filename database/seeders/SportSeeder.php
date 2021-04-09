<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    protected $names = ['zwemmen', 'lopen', 'fietsen', 'voetballen', 'turnen'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->names as $name){
            Sport::create([
                'name' => $name
            ]);
        }
    }
}
