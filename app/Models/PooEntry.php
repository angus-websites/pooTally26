<?php

namespace App\Models;

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use Carbon\Carbon;
use Database\Factories\PooEntryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
