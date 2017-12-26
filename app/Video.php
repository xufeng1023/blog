<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['post_id', 'slug', 'link'];

    protected $visible = ['slug', 'link', 'is_free'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function deleteFiles()
    {
    	if(Storage::disk('public')->exists($this->link)) {
            Storage::disk('public')->delete($this->link);
        }

        return $this;
    }

    public function clearPreview()
    {
        $this->post->videos->each(function($item) {
            $item->is_free = 0;
            $item->save();
        });

        return $this;
    }

    public function newPreview()
    {
        $this->is_free = 1;
        $this->save();
    }

    public function clearOnePreview()
    {
        $this->is_free = 0;
        $this->save();
    }

    public function play()
    {
        //$file = storage_path('app/public/'.$this->link);
        
        Storage::disk('space')->setVisibility($this->link, 'public');
        $adapter = Storage::disk('space')->getAdapter();
        $client = $adapter->getClient();
        $client->registerStreamWrapper();

        $file = "s3://dollyisland/{$this->link}";
        // \Log::info("s43 file {$file}");
        (new VideoStream($file))->start();
    }
}
