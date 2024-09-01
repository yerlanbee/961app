<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $building_id
 * @property string $photo
 * @property float $square_from
 * @property float $square_to
 * @property int $rooms
 */
class Layout extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'building_id',
        'photo',
        'square_from',
        'square_to',
        'rooms'
    ];

    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
}
