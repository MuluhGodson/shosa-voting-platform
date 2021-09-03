<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RegionSeeder extends Seeder
{
    public function run()
    {
        DB::table('regions')->delete();
        $regions = array(
			array('code' => 'NW','name'=>'North West','country_id' => 1),
			array('code' => 'SW','name'=>'South West','country_id' => 1),
			array('code' => 'AD','name'=>'Adamawa','country_id' => 1),
			array('code' => 'CE','name'=>'Centre','country_id' => 1),
			array('code' => 'EA','name'=>'East','country_id' => 1),
			array('code' => 'FA','name'=>'Far North','country_id' => 1),
			array('code' => 'LIT','name'=>'Littoral','country_id' => 1),
			array('code' => 'NR','name'=>'North','country_id' => 1),
			array('code' => 'ST','name'=>'South','country_id' => 1),
			array('code' => 'WE','name'=>'West','country_id' => 1),
        );
		DB::table('regions')->insert($regions);
    }
}