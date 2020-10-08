<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'name'              => 'Top Menu'
        ]);
        DB::table('menus')->insert([
            'name'              => 'Footer Menu 1'
        ]);
        DB::table('menus')->insert([
            'name'              => 'Footer Menu 2'
        ]);
    }
}
