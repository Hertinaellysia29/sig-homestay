<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Wisata;
use App\Models\Desa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        // User::create([
        //     'name' => 'Hertina Sinurat',
        //     'email' => 'hertina@gmail.com',
        //     'password' => bcrypt('hertina')
        // ]);

        // User::create([
        //     'name' => 'Jhonson Hutagaol',
        //     'email' => 'jhonson@gmail.com',
        //     'password' => bcrypt('jhonson')
        // ]);

        Desa::create([
            'nama' => 'Tarabunga'
        ]);

        Desa::create([
            'nama' => 'Lumban Bul-bul'
        ]);

        // Wisata::create([
        //     'desa_id'=> 1,
        //     'user_id' => 1,
        //     'nama'=> 'Lumban Bul-bul',
        //     'deskripsi' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        //     'lokasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        // ]);

        
        // Wisata::create([
        //     'desa_id'=> 2,
        //     'user_id' => 2,
        //     'nama'=> 'Pantai LBS',
        //     'deskripsi' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        //     'lokasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        // ]);

        Wisata::factory(5)->create();
    }
}
