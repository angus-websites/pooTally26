<?php

namespace App\Models;

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use Carbon\Carbon;
use Database\Factories\PooEntryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id
 * @property Carbon $occurred_at
 * @property ?PooConsistency $consistency
 * @property ?PooColour $colour
 * @property ?string $notes
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class PooEntry extends Model
{
    /** @use HasFactory<PooEntryFactory> */
    use HasFactory;

    protected $fillable = [
        'occurred_at',
        'consistency',
        'colour',
        'notes',
    ];

    protected $casts = [
        'consistency' => PooConsistency::class,
        'colour' => PooColour::class,
    ];

    /**
     * Scope a query to only include entries for a given year.
     * @param Builder $query
     * @param int $year
     * @return Builder
     */
    public function scopeForYear(Builder $query, int $year): Builder
    {
        return $query->whereYear('occurred_at', $year);
    }

    /**
     * Scope a query to only include entries for a given month of a year.
     * @param Builder $query
     * @param int $year
     * @param int $month
     * @return Builder
     */
    public function scopeForMonth(
        Builder $query,
        int $year,
        int $month
    ): Builder {
        return $query->whereYear('occurred_at', $year)
            ->whereMonth('occurred_at', $month);
    }

    /**
     * Scope a query to only include entries between two dates.
     * @param Builder $query
     * @param Carbon $from
     * @param Carbon $to
     * @return Builder
     */
    public function scopeBetweenDates(
        Builder $query,
        Carbon $from,
        Carbon $to
    ): Builder {
        return $query->whereBetween('occurred_at', [$from, $to]);
    }
}
