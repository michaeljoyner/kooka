<?php

namespace App\Stock;

use App\HasModelImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMediaConversions
{
    use Sluggable, SoftDeletes, HasMediaTrait, HasModelImage;

    protected $table = 'products';

    protected $dates = ['deleted_at'];

    protected $casts = [
        'available' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'description',
        'writeup',
        'price',
        'available'
    ];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 600, 'h' => 600, 'fit' => 'max'])
            ->performOnCollections('default');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function updateFromUserInput($attributes)
    {
        return $this->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'writeup' => $attributes['writeup'],
            'price' => Price::fromInputString($attributes['price'])->inCents()
        ]);
    }

    public function defaultImageSrc()
    {
        return '/images/assets/default.jpg';
    }

    public function getPriceAttribute($price)
    {
        return Price::fromCents($price);
    }

    public function setAvailabilityTo($isAvailable)
    {
        $this->available = $isAvailable;
        $this->save();

        return $this->available;
    }

    protected function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    protected function getGallery()
    {
        return $this->galleries()->firstOrCreate([]);
    }

    public function addGalleryImage($file)
    {
        return $this->getGallery()->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function getGalleryMedia()
    {
        return $this->getGallery()->getMedia();
    }

    public function clearGallery()
    {
        $this->getGallery()->clearMediaCollection();
    }
}
