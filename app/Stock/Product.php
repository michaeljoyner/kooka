<?php

namespace App\Stock;

use App\Breadcrumbs\Breadcrumbable;
use App\Breadcrumbs\BreadcrumbsTrait;
use App\HasModelImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMediaConversions, Breadcrumbable
{
    use Sluggable, SoftDeletes, HasMediaTrait, HasModelImage, BreadcrumbsTrait;

    protected $table = 'products';

    protected $dates = ['deleted_at'];

    protected $casts = [
        'available' => 'boolean',
        'promoted' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'description',
        'writeup',
        'price',
        'available'
    ];

    protected $breadcrumbs = [
        'parent' => 'category',
        'unique' => 'slug',
        'base_url' => '/products/',
        'build_name_from' => 'name'
    ];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop', 'fm' => 'png'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 600, 'h' => 600, 'fit' => 'max', 'fm' => 'png'])
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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

    public function promote()
    {
        $this->promoted = true;
        return $this->save();
    }

    public function demote()
    {
        $this->promoted = false;
        return $this->save();
    }

    public function isPromoted()
    {
        return $this->promoted;
    }
}
