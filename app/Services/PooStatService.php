<?php

namespace App\Services;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\User;

/**
 * Service for managing Poo statistics.
 */
class PooStatService
{
    public function __construct(
        protected PooEntryRepositoryInterface $repository
    ) {}

    /**
     * Get total number of Poo entries for a user all time.
     *
     * @param  User  $user  The user to get stats for.
     * @return int Total number of Poo entries.
     */
    public function poosTotal(User $user): int
    {
        return $this->repository->count($user);
    }

    /**
     * Get total number of Poo entries for a user in the last 7 days.
     *
     * @param  User  $user  The user to get stats for.
     * @return int Total number of Poo entries in the last 7 days.
     */
    public function poosLast7Days(User $user): int
    {
        return $this->repository->countInDateRange(
            $user,
            now()->subDays(7),
            now());
    }

    /**
     * Get total number of Poo entries for a user in the current month.
     *
     * @param  User  $user  The user to get stats for.
     * @return int Total number of Poo entries in the current month.
     */
    public function poosThisMonth(User $user): int
    {
        return $this->repository->countInDateRange(
            $user,
            now()->startOfMonth(),
            now());
    }

    public function averagePoosPerDay(User $user): float
    {
        $totalPoos = $this->poosTotal($user);

        // Get the date of the first Poo entry
        $firstEntry = $this->repository->first($user);

        if (! $firstEntry) {
            return 0.0;
        }

        // Calculate the number of days since the first entry (inclusive)
        $daysSinceFirstEntry = abs(now()->diffInDays($firstEntry->occurred_at)) + 1;

        // Calculate average with float precision
        return round($totalPoos / $daysSinceFirstEntry, 2);

    }
}
