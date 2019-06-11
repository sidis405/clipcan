<?php

namespace App;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Intervention\Image\Facades\Image as IImage;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Image extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $with = ['media'];
    protected $hidden = ['media'];
    protected $appends = [
        'thumb',
        'mark',
        'original'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function getOriginalAttribute()
    {
        return $this->media->first()->getUrl();
    }

    public function getThumbAttribute()
    {
        return $this->media->first()->getUrl('thumb');
    }

    public function getMarkAttribute()
    {
        return $this->media->first()->getUrl('mark');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $conversion = $this->addMediaConversion('mark');

        $conversion->background('32323c')
            ->watermark(public_path('mark.jpg'))
            ->watermarkOpacity(50)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkWidth(40, Manipulations::UNIT_PERCENT);

        /////////

        $image = IImage::make($media->getPath());
        $width = $image->width();
        $height = $image->height();

        $ratio = $width / $height;

        $conversion = $this->addMediaConversion('thumb');

        if ($width >= $height) {
            $conversion->fit(Manipulations::FIT_CROP, 160, 101);
        } else {
            $conversion->fit(Manipulations::FIT_FILL, $ratio * 160, $ratio * 101);
        }

        $conversion->background('32323c')
            ->watermark(public_path('mark.jpg'))
            ->watermarkOpacity(50)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkWidth(40, Manipulations::UNIT_PERCENT);
    }
}
