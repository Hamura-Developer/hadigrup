<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('landingpages')->insert([
            'judul'             => 'hadigrup.com',
            'deskripsi'         => 'Web Developer, Digital Agency and Consulting IT',
            'link'              => 'http://hadigrup.com',
            'text_link'         => 'Visit',
            'fonticon1'         => '',
            'judulfitur1'       => '',
            'konten1'           => '',
            'link1'             => '',
            'text_link1'        => '',
            'fonticon2'         => '',
            'judulfitur2'       => '',
            'konten2'           => '',
            'link2'             => '',
            'text_link2'        => '',
            'fonticon3'         => '',
            'judulfitur3'       => '',
            'konten3'           => '',
            'link3'             => '',
            'text_link3'        => ''
            
        ]);
    }
}
