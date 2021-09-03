<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    protected $table = "countries";

    public function regions()
    {
       return $this->hasMany(Region::class, 'country_id');
    }
}
