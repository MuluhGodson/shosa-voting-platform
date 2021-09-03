<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->delete();
        $countries = array(
            array('code' => 'CM', 'name' => 'Cameroon', 'phonecode' => '237', 'currency' => 'FCFA'),
        );
        DB::table('countries')->insert($countries);
    }
}