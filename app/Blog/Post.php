<?php

namespace App\Blog;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Post extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'description',
        'body',
        'published',
        'published_at'
    ];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max'])
            ->performOnCollections('default');
    }

    public function addImage($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function getImages()
    {
        return $this->getMedia();
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setPublishedStatus($shouldPublish)
    {
        $this->published = $shouldPublish;
        return $this->save();
    }
}
