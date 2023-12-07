<?php

namespace Keky\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Keky\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'slug',
        'status',
        'external_id',
        'thumbnail',
        'weight',
        'height',
        'width',
        'type_id',
        'metadata',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function collections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'products_collections');
    }
}
