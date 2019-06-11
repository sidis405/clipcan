<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
                'slug' => [
                    'source' => 'name'
                ]
            ];
    }

    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'taggable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
