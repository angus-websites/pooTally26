@extends('layouts.public')

@section('title', 'Welcome')

@section('content')
    <x-page-container>
        <div>
            <div class="mx-auto max-w-3xl md:text-center">
                <p class="text-base/7 font-semibold  text-brown-600 dark:text-brown-400">PooTally</p>
                <h1 class="mt-2 font-shantell text-5xl font-bold tracking-tight text-pretty text-gray-900 sm:text-5xl md:text-6xl lg:text-balance dark:text-white">
                    Keep count, one <span class="block text-brown-500 dark:text-brown-400 xl:inline">Poo</span> at a time
                </h1>
                <p class="mt-6 text-lg/7 text-gray-500 dark:text-gray-400  max-w-md md:max-w-xl md:mx-auto">
                    PooTally helps you track your bowel movements with ease, providing helpful insights and statistics.
                </p>

                <div class="mx-auto mt-5 sm:flex md:justify-center md:mt-8">
                    <div class="rounded-md shadow-sm">
                        <a href="{{ route('register') }}"
                           class="flex w-full items-center justify-center rounded-md border border-transparent bg-brown-500 dark:bg-brown-400 dark:hover:bg-brown-300 px-8 py-3 text-base font-medium text-white dark:text-brown-800 hover:bg-brown-600 md:px-10 md:py-4 md:text-lg">
                            Get
                            started
                        </a>
                    </div>
                </div>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-gray-900 dark:text-white">
                            <div
                                class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-zinc-200 dark:bg-white">
                                <flux:icon.chart-bar class="text-brown-700"/>
                            </div>
                            Effortless tracking
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-600 dark:text-gray-400">
                            Quickly log your log with just a few taps. No more messy notes or forgotten details.
                        </dd>
                    </div>
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-gray-900 dark:text-white">
                            <div
                                class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-zinc-200 dark:bg-white">
                                <flux:icon.lock-closed class="text-brown-700"/>
                            </div>
                            Privacy first
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-600 dark:text-gray-400">
                            Your data stays yours. Anonymous by default, no tracking, no selling, ever.
                        </dd>
                    </div>
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-gray-900 dark:text-white">
                            <div
                                class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-zinc-200 dark:bg-white">
                                <flux:icon.presentation-chart-line class="text-brown-700"/>
                            </div>
                            Stats & insights
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-600 dark:text-gray-400">
                            See daily averages, monthly totals, streaks, and trends beautifully visualised.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </x-page-container>
@endsection
