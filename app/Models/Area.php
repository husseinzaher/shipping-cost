<?php

namespace App\Models;

use App\Enums\AreaType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $city
 * @property string $area
 * @property AreaType $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin Builder
 */
class Area extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'area', 'type'];

    protected $casts = [
        'city' => 'string',
        'area' => 'string',
        'type' => AreaType::class,
    ];
}
