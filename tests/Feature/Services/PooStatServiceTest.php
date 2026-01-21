<?php

use App\Contracts\PooEntryRepositoryInterface;
use App\Models\PooEntry;
use App\Models\User;
use App\Services\PooStatService;
use Carbon\Carbon;
use Carbon\CarbonInterface;

beforeEach(function () {
    $this->user = User::factory()->make();

    $this->repository = Mockery::mock(PooEntryRepositoryInterface::class);

    $this->service = new PooStatService($this->repository);
});

it('returns total poos', function () {
    $this->repository
        ->shouldReceive('count')
        ->with($this->user)
        ->once()
        ->andReturn(42);

    expect($this->service->poosTotal($this->user))->toBe(42);
});

it('returns poos in last 7 days', function () {
    // Mock Carbon now
    Carbon::setTestNow(Carbon::parse('2026-01-02'));

    $this->repository
        ->shouldReceive('countInDateRange')
        ->with(
            $this->user,
            Mockery::on(fn ($d) => $d instanceof CarbonInterface && $d->isSameDay(now()->subDays(7))),
            Mockery::on(fn ($d) => $d instanceof CarbonInterface && $d->isSameDay(now()))
        )
        ->once()
        ->andReturn(5);

    expect($this->service->poosLast7Days($this->user))->toBe(5);
});

it('returns poos this month', function () {
    // Mock Carbon now
    Carbon::setTestNow(Carbon::parse('2026-01-02'));

    $this->repository
        ->shouldReceive('countInDateRange')
        ->with(
            $this->user,
            Mockery::on(fn ($d) => $d instanceof CarbonInterface && $d->isSameDay(now()->startOfMonth())),
            Mockery::on(fn ($d) => $d instanceof CarbonInterface && $d->isSameDay(now()))
        )
        ->once()
        ->andReturn(12);

    expect($this->service->poosThisMonth($this->user))->toBe(12);
});

it('calculates average poos per day', function () {
    $firstEntryDate = now()->subDays(4);

    $this->repository
        ->shouldReceive('count')
        ->with($this->user)
        ->once()
        ->andReturn(20);

    $this->repository
        ->shouldReceive('first')
        ->with($this->user)
        ->once()
        ->andReturn(
            PooEntry::factory()->make([
                'occurred_at' => $firstEntryDate,
            ])
        );

    // 4 days ago → 5 days inclusive
    expect($this->service->averagePoosPerDay($this->user))->toBe(4.0); // 20 / 5
});

it('returns 0 for average if no entries', function () {
    $this->repository
        ->shouldReceive('count')
        ->with($this->user)
        ->andReturn(0);

    expect($this->service->averagePoosPerDay($this->user))->toBe(0.0);
});
