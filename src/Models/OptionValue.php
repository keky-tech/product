<?php

namespace Keky\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Keky\Product\Database\Factories\OptionValueFactory;

class OptionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'metadata',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return OptionValueFactory::new();
    }
}
