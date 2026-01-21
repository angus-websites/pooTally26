<?php

namespace App\Services;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new PooEntry.
     */
    public function create(array $data, ?User $user = null): PooEntry
    {
        // If User not provided, set to currently authenticated user
        if (! $user) {
            $user = Auth::user();
        }

        return $this->repository->create($user, $data);
    }

    public function delete(PooEntry $entry): void
    {
        $this->repository->delete($entry);
    }
}
