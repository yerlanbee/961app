<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $square_from
 * @property string $square_to
 * @property int $number_floors
 * @property int $number_apartments
 * @property int $number_parking_spaces
 * @property string $photo
 */
class Building extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'square_from',
        'square_to',
        'number_floors',
        'number_apartments',
        'number_parking_spaces',
        'photo'
    ];

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->HasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function price(): HasOne
    {
        return $this->HasOne(BuildingPricing::class);
    }

    /**
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * @return HasMany
     */
    public function layouts(): HasMany
    {
        return $this->hasMany(Layout::class);
    }

    /**
     * @return BelongsToMany
     */
    public function advantages(): BelongsToMany
    {
        return $this->belongsToMany(Advantage::class)->wherePivot('title');
    }

    /**
     * @return BelongsToMany
     */
    public function issuances(): BelongsToMany
    {
        return $this->belongsToMany(Issuance::class)->wherePivot('title');
    }

    /**
     * @return BelongsToMany
     */
    public function houseClasses(): BelongsToMany
    {
        return $this->belongsToMany(HouseClass::class)->wherePivot('title');
    }

    /**
     * @return BelongsToMany
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class)->wherePivot('title');
    }

    /**
     * @return BelongsToMany
     */
    public function landscapings(): BelongsToMany
    {
        return $this->belongsToMany(Landscaping::class)->wherePivot('title');
    }
}
