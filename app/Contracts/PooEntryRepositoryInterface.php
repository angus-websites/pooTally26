<?php

namespace App\Contracts;

use App\Models\PooEntry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface PooEntryRepositoryInterface
{
    public function find(User $user, int $id): ?PooEntry;

    public function first(User $user): ?PooEntry;

    public function all(User $user): Collection;

    public function inDateRange(
        User $user,
        Carbon $from,
        Carbon $to
    ): Collection;

    public function count(User $user): int;

    public function countInDateRange(
        User $user,
        Carbon $from,
        Carbon $to
    ): int;

    public function create(User $user, array $data): PooEntry;

    public function update(PooEntry $entry, array $data): PooEntry;

    public function delete(PooEntry $entry): void;
}
