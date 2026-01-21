<?php

use App\Services\PooStatService;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public int $totalPoos = 0;
    public int $poosLast7Days = 0;
    public int $poosThisMonth = 0;
    public float $averagePoosPerDay = 0.0;

    public function mount(PooStatService $statService)
    {
        $this->refreshStats($statService);
    }

    #[On('poo-entry:refresh')]
    public function refreshStats(PooStatService $statService): void
    {
        $user = auth()->user();
        $this->totalPoos = $statService->poosTotal($user);
        $this->poosLast7Days = $statService->poosLast7Days($user);
        $this->poosThisMonth = $statService->poosThisMonth($user);
        $this->averagePoosPerDay = $statService->averagePoosPerDay($user);
    }
};
?>

<dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
            Total Poos Logged
        </dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
            {{ $totalPoos }}
        </dd>
    </div>
    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
            Total Poos (Last 7 days)
        </dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
            {{ $poosLast7Days }}
        </dd>
    </div>
    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
            Total Poos (This Month)
        </dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
            {{ $poosThisMonth }}
        </dd>
    </div>
    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
            Average Poos Per day
        </dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
            {{ number_format($averagePoosPerDay, 2) }}
        </dd>
    </div>
</dl>
