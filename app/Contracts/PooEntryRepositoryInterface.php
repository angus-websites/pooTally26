<?php

namespace App\Contracts;
use App\Models\PooEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface PooEntryRepositoryInterface
{
    public function find(int $id): ?PooEntry;

    public function create(array $data): PooEntry;

    public function update(PooEntry $entry, array $data): PooEntry;

    public function delete(PooEntry $entry): void;

    public function forDateRange(Carbon $from, Carbon $to): Collection;

    public function all(): Collection;
}
