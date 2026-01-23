<?php

namespace App\Repositories;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function find(int $id): ?PooEntry
    {
        return PooEntry::find($id);
    }

    public function first(User $user): ?PooEntry
    {
        return $this->queryFor($user)
            ->latest('occurred_at')
            ->first();
    }

    public function all(User $user): Collection
    {
        return $this->queryFor($user)
            ->latest('occurred_at')
            ->get();
    }

    public function paginate(
        User $user,
        int $perPage
    ): LengthAwarePaginator {
        return $this->queryFor($user)
            ->latest('occurred_at')
            ->paginate($perPage);
    }

    public function inDateRange(
        User $user,
        CarbonInterface $from,
        CarbonInterface $to
    ): Collection {
        return $this->queryFor($user)
            ->whereBetween('occurred_at', [$from, $to])
            ->latest('occurred_at')
            ->get();
    }

    public function count(User $user): int
    {
        return $this->queryFor($user)->count();
    }

    public function countInDateRange(
        User $user,
        CarbonInterface $from,
        CarbonInterface $to
    ): int {
        return $this->queryFor($user)
            ->whereBetween('occurred_at', [$from, $to])
            ->count();
    }

    public function create(User $user, array $data): PooEntry
    {

        $combinedData = array_merge($data, ['user_id' => $user->id]);

        return PooEntry::create(
            $combinedData
        );
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
