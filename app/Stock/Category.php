<?php

namespace App\Stock;

use App\HasModelImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Category extends Model implements HasMediaConversions
{
    use Sluggable, SluggableScopeHelpers, SoftDeletes, HasMediaTrait, HasModelImage;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description'
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

    protected $dates = ['deleted_at'];

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

    public function defaultImageSrc()
    {
        return '/images/assets/default.jpg';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function addProduct($attributes)
    {
        return $this->products()->create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'price' => Price::fromInputString($attributes['price'])->inCents()
        ]);
    }
}
