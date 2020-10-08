<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->insert([
            'website'           => 'http://127.0.0.1:8000',
            'nama'              => 'Hadi Grup',
            'slogan'            => 'Web Developer, Digital Agency and Consulting IT',
            'deskripsi_situs'   => 'Web Developer, Digital Agency and Consulting IT',
            'meta_deskripsi'    => 'Web Developer, Digital Agency and Consulting IT',
            'telepon'           => '',
            'alamat'            => 'Yogyakarta',
            'email_website'     => 'info@hadigrup.com',
            'logo'              => 'logo.png',
            'favicon'           => 'favicon.png',
            'facebook'          => '',
            'twitter'           => '',
            'instagram'         => '',
            'linkedin'          => ''
        ]);
    }
}
