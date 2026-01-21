<?php

namespace App\Observers;

use App\Models\PooEntry;
use Illuminate\Support\Facades\Cache;

class PooEntryObserver
{
    /**
     * Handle the PooEntry "created" event.
     */
    public function created(PooEntry $pooEntry): void
    {
        $this->invalidate($pooEntry->user_id);
    }

    /**
     * Handle the PooEntry "updated" event.
     */
    public function updated(PooEntry $pooEntry): void
    {
        $this->invalidate($pooEntry->user_id);
    }

    /**
     * Handle the PooEntry "deleted" event.
     */
    public function deleted(PooEntry $pooEntry): void
    {
        $this->invalidate($pooEntry->user_id);
    }

    /**
     * Handle the PooEntry "restored" event.
     */
    public function restored(PooEntry $pooEntry): void
    {
        $this->invalidate($pooEntry->user_id);
    }

    /**
     * Handle the PooEntry "force deleted" event.
     */
    public function forceDeleted(PooEntry $pooEntry): void
    {
        $this->invalidate($pooEntry->user_id);
    }

    /**
     * Invalidate cached statistics for a user.
     */
    protected function invalidate(int $userId): void
    {
        Cache::forget("poo:stats:{$userId}:total");
        Cache::forget("poo:stats:{$userId}:last7");
        Cache::forget("poo:stats:{$userId}:month:".now()->format('Y-m'));
        Cache::forget("poo:stats:{$userId}:average:".now()->toDateString());
    }
}
