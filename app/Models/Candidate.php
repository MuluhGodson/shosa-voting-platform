<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Utils\Division;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
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

    public function contests()
    {
        return $this->belongsToMany(Contest::class, 'candidate_contest', 'candidate_id', 'contest_id')->withPivot('paid','candidate_number');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id');
    }
}
