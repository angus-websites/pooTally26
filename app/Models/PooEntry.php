<?php

namespace App\Models;

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use Database\Factories\PooEntryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $occurred_at
 * @property ?PooConsistency $consistency
 * @property ?PooColour $colour
 * @property ?string $notes
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 *
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
        'occurred_at' => 'datetime',
        'consistency' => PooConsistency::class,
        'colour' => PooColour::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include entries for a given user.
     */
    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Scope a query to only include entries for a given year.
     */
    public function scopeForYear(Builder $query, int $year): Builder
    {
        return $query->whereYear('occurred_at', $year);
    }

    /**
     * Scope a query to only include entries for a given month of a year.
     */
    public function scopeForMonth(
        Builder $query,
        int $year,
        int $month
    ): Builder {
        return $query->whereYear('occurred_at', $year)
            ->whereMonth('occurred_at', $month);
    }

}
