<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OptionValue
 *
 * @property int $id
 * @property string|null $string
 * @property int|null $option_id
 * @property string|null $metadata
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OptionValue extends Model
{
    protected $table = 'option_values';

    protected $casts = [
        'option_id' => 'int',
    ];

    protected $fillable = [
        'value',
        'option_id',
        'metadata',
    ];
}
