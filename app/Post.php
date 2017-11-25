<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'views'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['thumbnail'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
    	return $this->hasMany(Image::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function deleteImages()
    {
    	$this->images->each(function($item) {
            $item->deleteFiles()->delete();
        });

        return $this;
    }

    public function deleteVideos()
    {
        $this->videos->each(function($item) {
            $item->deleteFiles()->delete();
        });

        return $this;
    }

    public function updateViews()
    {
        $this->increment('views');
        $this->save();
    }

    public function getPreviewAttribute()
    {
        $canWatch = auth()->user()? auth()->user()->can('watch', $this) : false;
        $video = $this->videos->where('is_free', !$canWatch)->first();
        return $video ?: $this->videos->first();
    }

    public function getThumbnailAttribute()
    {
        return $this->images->where('is_thumbnail', 1)->first();
    }
    // admin
    public function videoSlug()
    {
        return $this->slug . '-' .($this->videos->count() + 1);
    } 
}
