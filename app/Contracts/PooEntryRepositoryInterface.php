<?php

namespace App\Contracts;

use App\Models\PooEntry;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

interface PooEntryRepositoryInterface
{
    public function find(User $user, int $id): ?PooEntry;

    public function first(User $user): ?PooEntry;

    public function all(User $user): Collection;

    public function inDateRange(
        User $user,
        CarbonInterface $from,
        CarbonInterface $to
    ): Collection;

    public function count(User $user): int;

    public function countInDateRange(
        User $user,
        CarbonInterface $from,
        CarbonInterface $to
    ): int;

    public function create(User $user, array $data): PooEntry;

    public function update(PooEntry $entry, array $data): PooEntry;

    public function delete(PooEntry $entry): void;
}
