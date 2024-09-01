<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $title
 * @property string $description
 * @property string $photo
 */
class Advantage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photo'
    ];

    /**
     * @return BelongsToMany
     */
    public function buildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class);
    }
}
