<?php

namespace App\Services;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Service class for managing PooEntry entities.
 */
class PooEntryService
{
    public function __construct(
        protected PooEntryRepositoryInterface $repository
    ) {}

    /**
     * Find a PooEntry by its ID.
     */
    public function find(int $id): ?PooEntry
    {
        return $this->repository->find($id);
    }

    public function paginatePoos(): LengthAwarePaginator
    {
        $perPage = config('poo.index_per_page', 20);
        $user = Auth::user();
        return $this->repository->paginate($user, $perPage);
    }

    /**
     * Get the latest PooEntries for a given user, limited by the specified number.
     */
    public function latestForUser(User $user): Collection
    {
        $limit = config('poo.dashboard_recent_limit', 5);

        return Cache::rememberForever(
            "poo:entries:{$user->id}:latest:{$limit}",
            fn () => $user->pooEntries()
                ->latest('occurred_at')
                ->limit($limit)
                ->get()
        );
    }

    /**
     * Create a new PooEntry.
     */
    public function create(array $data): PooEntry
    {
        $user = Auth::user();
        return $this->repository->create($user, $data);
    }

    /**
     * Delete a PooEntry.
     */
    public function delete(PooEntry $entry): void
    {
        $this->repository->delete($entry);
    }
}
