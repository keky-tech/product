<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Option
 *
 * @property int $id
 * @property int|null $number
 * @property string|null $string
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Option extends Model
{
    protected $table = 'options';

    protected $casts = [
        'title' => 'int',
    ];

    protected $fillable = [
        'title',
    ];
}
