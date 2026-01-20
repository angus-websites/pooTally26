<?php

namespace App\Services;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Service class for managing PooEntry entities.
 */
class PooEntryService
{
    public function __construct(
        protected PooEntryRepositoryInterface $repository
    ) {}

    public function list(): Collection
    {
        return $repository = $this->repository->all();
    }

    public function get(int $id): ?PooEntry
    {
        return $this->repository->find($id);
    }

    public function create(array $data, ?User $user = null): PooEntry
    {
        // If User not provided, set to currently authenticated user
        if (! $user) {
            $user = Auth::user();
        }

        return $user->pooEntries()->create($data);
    }

    public function update(int $id, array $data): PooEntry
    {
        $entry = $this->repository->find($id);

        if (! $entry) {
            throw new \RuntimeException('PooEntry not found');
        }

        return $this->repository->update($entry, $data);
    }

    public function delete(int $id): void
    {
        $entry = $this->repository->find($id);

        if ($entry) {
            $this->repository->delete($entry);
        }
    }

    public function entriesBetween(
        Carbon $from,
        Carbon $to
    ): Collection {
        return $this->repository->forDateRange($from, $to);
    }
}
