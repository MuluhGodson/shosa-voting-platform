<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = "regions";


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    
    public function divisions()
    {
        return $this->hasMany(Division::class, 'division_id');
    }
}
