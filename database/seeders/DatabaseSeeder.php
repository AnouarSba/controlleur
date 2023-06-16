<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);
        $this->call(Arrets::class);
        $this->call(Lignes::class);
        $this->call(Buses::class);
        $this->call(Kabids::class);
        $this->call(Chauffeurs::class);
        $this->call(fkabids::class);
        $this->call(fchauffeurs::class);
    }
}
