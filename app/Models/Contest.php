<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    use HasSlug;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_contest', 'contest_id', 'candidate_id')->withPivot('paid','candidate_number');
    }

}
