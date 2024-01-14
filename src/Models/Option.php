<?php

namespace Keky\Product\Models;


use Keky\Product\Database\Factories\OptionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return OptionFactory::new();
    }

    public function optionValues(): HasMany
    {
        return $this->hasMany(OptionValue::class);
    }

    public function productsOpt(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_options');
    }
}
