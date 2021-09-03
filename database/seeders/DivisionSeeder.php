<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisions')->delete();
        $divisions = array(
            //NW
                    array('name'=>'Mezam', 'region_id'=> 1),
                    array('name'=>'Boyo', 'region_id'=> 1),
                    array('name'=>'Bui', 'region_id'=> 1),
                    array('name'=>'Menchum', 'region_id'=> 1),
                    array('name'=>'Momo', 'region_id'=> 1),
                    array('name'=>'Donga-Mantung', 'region_id'=> 1),
                    array('name'=>'Ngo-ketunjia', 'region_id'=> 1),
            //SW
                    array('name'=>'Fako', 'region_id'=>2),
                    array('name'=>'Koupé-Manengouba', 'region_id'=>2),
                    array('name'=>'Lebialem', 'region_id'=>2),
                    array('name'=>'Manyu', 'region_id'=>2),
                    array('name'=>'Meme', 'region_id'=>2),
                    array('name'=>'Ndian', 'region_id'=>2),
            //Adamoua		
                    array('name'=>'Djérem', 'region_id'=>3),
                    array('name'=>'Faro-et-Déo', 'region_id'=>3),
                    array('name'=>'Mayo-Banyo', 'region_id'=>3),
                    array('name'=>'Mbéré', 'region_id'=>3),
                    array('name'=>'Vina', 'region_id'=>3),
            //Center
                    array('name'=>'Haute-Sanaga', 'region_id'=>4),
                    array('name'=>'Lekié', 'region_id'=>4),
                    array('name'=>'Mbam-et-Inoubou', 'region_id'=>4),
                    array('name'=>'Mbam-et-Kim', 'region_id'=>4),
                    array('name'=>'Méfou-et-Afamba', 'region_id'=>4),
                    array('name'=>'Méfou-et-Akono', 'region_id'=>4),
                    array('name'=>'Mfoundi', 'region_id'=>4),
                    array('name'=>'Nyong-et-Kéllé', 'region_id'=>4),
                    array('name'=>'Nyong-et-Mfoumou', 'region_id'=>4),
                    array('name'=>'Nyong-et-So\'o', 'region_id'=>4),
            //East
                    array('name'=>'Boumba-et-Ngoko', 'region_id'=>5),
                    array('name'=>'Haut-Nyong', 'region_id'=>5),
                    array('name'=>'Kadey', 'region_id'=>5),
                    array('name'=>'Lom-et-Djerem', 'region_id'=>5),
        
            //Far North
                    array('name'=>'Diamaré', 'region_id'=>6),
                    array('name'=>'Logone-et-Chari', 'region_id'=>6),
                    array('name'=>'Mayo-Danay', 'region_id'=>6),
                    array('name'=>'Mayo-Kani', 'region_id'=>6),
                    array('name'=>'Mayo-Sava', 'region_id'=>6),
                    array('name'=>'Mayo-Tsanaga', 'region_id'=>6),
            //Lit
                    array('name'=>'Moungo', 'region_id'=>7),
                    array('name'=>'Nkam', 'region_id'=>7),
                    array('name'=>'Sanaga-Maritime', 'region_id'=>7),
                    array('name'=>'Wouri', 'region_id'=>7),
            //North
                    array('name'=>'Bénoué', 'region_id'=>8),
                    array('name'=>'Faro', 'region_id'=>8),
                    array('name'=>'Mayo-Louti', 'region_id'=>8),
                    array('name'=>'Mayo-Rey', 'region_id'=>8),
            //South
                    array('name'=>'Dja-et-Lobo', 'region_id'=>9),
                    array('name'=>'Mvila', 'region_id'=>9),
                    array('name'=>'Océan', 'region_id'=>9),
                    array('name'=>'Vallée-du-Ntem', 'region_id'=>9),
            //West
                    array('name'=>'Bamboutos', 'region_id'=>10),
                    array('name'=>'Haut-Nkam', 'region_id'=>10),
                    array('name'=>'Hauts-Plateaux', 'region_id'=>10),
                    array('name'=>'Koung-Khi', 'region_id'=>10),
                    array('name'=>'Menoua', 'region_id'=>10),
                    array('name'=>'Mifi', 'region_id'=>10),
                    array('name'=>'Ndé', 'region_id'=>10),
                    array('name'=>'Noun', 'region_id'=>10),
        );
        
       DB::table('divisions')->insert($divisions);
        
    }
}