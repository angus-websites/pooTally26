<?php

namespace App\Services;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

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
        return Cache::rememberForever(
            "poo:stats:{$user->id}:total",
            fn () => $this->repository->count($user)
        );
    }

    /**
     * Get total number of Poo entries for a user in the last 7 days.
     *
     * @param  User  $user  The user to get stats for.
     * @return int Total number of Poo entries in the last 7 days.
     */
    public function poosLast7Days(User $user): int
    {
        return Cache::rememberForever(
            "poo:stats:{$user->id}:last7",
            fn () => $this->repository->countInDateRange(
                $user,
                now()->subDays(7),
                now()
            )
        );
    }

    /**
     * Get total number of Poo entries for a user in the current month.
     *
     * @param  User  $user  The user to get stats for.
     * @return int Total number of Poo entries in the current month.
     */
    public function poosThisMonth(User $user): int
    {
        $month = now()->format('Y-m');

        return Cache::rememberForever(
            "poo:stats:{$user->id}:month:{$month}",
            fn () => $this->repository->countInDateRange(
                $user,
                now()->startOfMonth(),
                now()
            )
        );
    }

    /**
     * Calculate the average number of Poo entries per day for a user.
     *
     * @param  User  $user  The user to get stats for.
     * @return float Average number of Poo entries per day.
     */
    public function averagePoosPerDay(User $user): float
    {
        $day = now()->toDateString();

        return Cache::rememberForever(
            "poo:stats:{$user->id}:average:{$day}",
            function () use ($user) {

                $totalPoos = $this->poosTotal($user);

                if ($totalPoos === 0) {
                    return 0.0;
                }

                $firstEntry = $this->repository->first($user);

                if (! $firstEntry) {
                    return 0.0;
                }

                $days = now()
                    ->startOfDay()
                    ->diffInDays($firstEntry->occurred_at->startOfDay(), absolute: true) + 1;

                return round($totalPoos / $days, 2);
            }
        );

    }
}
