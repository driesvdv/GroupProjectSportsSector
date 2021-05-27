<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Registrant;
use App\Models\Registration;
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
            $user = User::create([
                'name' => $name,
                'email' => $name . '@odisee.be',
                'email_verified_at' => now(),
                'password' => bcrypt($name),
                'sportclub_id' => $key + 1,
            ]);

            Registrant::factory()
                ->for($user)
                ->has(Registration::factory()->count(2))
                ->count(2)
                ->create();
        }
    }
}
