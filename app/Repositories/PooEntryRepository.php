<?php

namespace App\Repositories;

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PooEntryRepository implements PooEntryRepositoryInterface
{
    public function find(int $id): ?PooEntry
    {
        return PooEntry::find($id);
    }

    public function all(): Collection
    {
        return PooEntry::orderBy('occurred_at', 'desc')->get();
    }

    public function create(array $data): PooEntry
    {
        return PooEntry::create($data);
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

    public function forDateRange(Carbon $from, Carbon $to): Collection
    {
        return PooEntry::whereBetween('occurred_at', [$from, $to])
            ->orderBy('occurred_at')
            ->get();
    }
}
