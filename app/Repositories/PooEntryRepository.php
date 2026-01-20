<?php

namespace App\Repositories;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PooEntryRepository implements PooEntryRepositoryInterface
{
    /**
     * Base scoped query for a user
     */
    protected function queryFor(User $user)
    {
        return PooEntry::query()->forUser($user);
    }

    public function find(User $user, int $id): ?PooEntry
    {
        return $this->queryFor($user)->find($id);
    }

    public function first(User $user): ?PooEntry
    {
        return $this->queryFor($user)
            ->orderBy('occurred_at')
            ->first();
    }

    public function all(User $user): Collection
    {
        return $this->queryFor($user)
            ->orderByDesc('occurred_at')
            ->get();
    }

    public function inDateRange(
        User $user,
        Carbon $from,
        Carbon $to
    ): Collection {
        return $this->queryFor($user)
            ->whereBetween('occurred_at', [$from, $to])
            ->orderByDesc('occurred_at')
            ->get();
    }

    public function count(User $user): int
    {
        return $this->queryFor($user)->count();
    }

    public function countInDateRange(
        User $user,
        Carbon $from,
        Carbon $to
    ): int {
        return $this->queryFor($user)
            ->whereBetween('occurred_at', [$from, $to])
            ->count();
    }

    public function create(User $user, array $data): PooEntry
    {
        return PooEntry::create([
            ...$data,
            'user_id' => $user->id,
        ]);
    }

    public function update(PooEntry $entry, array $data): PooEntry
    {
        $entry->update($data);

        return $entry->refresh();
    }

    public function delete(PooEntry $entry): void
    {
        $entry->delete();
    }
}
