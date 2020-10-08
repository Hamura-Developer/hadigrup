<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            LandingpageSeeder::class,
            MapSeeder::class,
            MenuSeeder::class,
            AboutSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
