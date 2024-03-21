<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductOption
 *
 * @property int $id
 * @property int $product_id
 * @property int $option_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ProductOption extends Model
{
    protected $table = 'product_options';

    protected $casts = [
        'product_id' => 'int',
        'option_id' => 'int',
    ];

    protected $fillable = [
        'product_id',
        'option_id',
    ];
}
