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
            'username' => 'DG',
            'firstname' => 'DG',
            'lastname' => 'DG',
            'email' => 'DG@admin.com',
            'password' => bcrypt('secret')
        ]);
        DB::table('users')->insert([
            'username' => 'CHEF',
            'firstname' => 'Naceri',
            'lastname' => 'ibrahim',
            'email' => 'CHEF@admin.com',
            'password' => bcrypt('password')
        ]);

        DB::table('users')->insert([
            'username' => 'Dine-b',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'dine-b@gmail.com',
            'password' => bcrypt('dine301')
        ]);


        DB::table('users')->insert([
            'username' => 'Abdelmalek-m',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'abdelmalek-m@gmail.com',
            'password' => bcrypt('abdelmalek792')
        ]);


        DB::table('users')->insert([
            'username' => 'Dorbane-z',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'dorbane-z@gmail.com',
            'password' => bcrypt('dorbane462')
        ]);


        DB::table('users')->insert([
            'username' => 'Demmouche-m',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'demmouche-m@gmail.com',
            'password' => bcrypt('demmouche080')
        ]);


        DB::table('users')->insert([
            'username' => 'Mounir-issad',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'mounir-issad@gmail.com',
            'password' => bcrypt('mounir825')
        ]);


        DB::table('users')->insert([
            'username' => 'Zouaoui-bendriss',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'zouaoui-bendriss@gmail.com',
            'password' => bcrypt('zouaoui671')
        ]);


        DB::table('users')->insert([
            'username' => 'Ziani-ali',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'ziani-ali@gmail.com',
            'password' => bcrypt('ziani-ali943')
        ]);


        DB::table('users')->insert([
            'username' => 'Bouanani-zouaoui',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'bouanani-zouaoui@gmail.com',
            'password' => bcrypt('bouanani357')
        ]);


        DB::table('users')->insert([
            'username' => 'Marouf-bobo',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'marouf-bobo@gmail.com',
            'password' => bcrypt('marouf951')
        ]);


        DB::table('users')->insert([
            'username' => 'Berrahou-fethi',
            'firstname' => 'Controlleur',
            'lastname' => 'Controlleur',
            'email' => 'berrahou-fethi@gmail.com	',
            'password' => bcrypt('berrahou123')
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