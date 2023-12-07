<?php

namespace Keky\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Keky\Product\Database\Factories\CollectionFactory;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'metadata',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CollectionFactory::new();
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_collections');
    }
}
