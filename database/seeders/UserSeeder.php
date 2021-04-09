<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $names = ['Steven', 'Arthur', 'Dries'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $key => $name)
        {
            User::create([
                'name' => $name,
                'email' => $name . '@odisee.be',
                'password' => bcrypt($name),
                'sportclub_id' => $key + 1,
            ]);
        }
    }
}
