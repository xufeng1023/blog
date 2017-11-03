<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'views'];

    protected $with = ['images', 'videos'];

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
            $item->deleteThumbnail()->deleteFiles()->delete();
        });

        return $this;
    }

    public function getPreview()
    {
        $video = $this->videos()->orderBy('is_free', 'desc')->first();
        if($video) $video->load('thumbnail');
        return $video;
    }

    public function updateViews()
    {
        $this->increment('views');
        $this->save();
    }

    public function getPreviewAttribute()
    {
        $video = $this->videos->where('is_free', 1)->first();

        if(!$video) $video = $this->videos->first();

        return $video? $video : null;
    }

    public function getThumbnailAttribute()
    {
        $image = $this->images->where('is_thumbnail', 1)->first();
        return $image? $image->slug : null;
    }
}
