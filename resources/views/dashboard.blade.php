<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <livewire:pooentry.create-form/>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-scroll rounded-xl border border-neutral-200 dark:border-neutral-700">
                <dl class="divide-y divide-gray-100 dark:divide-white/10">
                    <div class="py-6 grid grid-cols-2 gap-4 px-5">
                        <dt class="text-base font-medium text-gray-900 dark:text-gray-100">Total Poos all time</dt>
                        <dd class="text-base text-gray-700 dark:text-gray-400">
                            10
                        </dd>
                    </div>
                    <div class="py-6 grid grid-cols-3 gap-4 px-5">
                        <dt class="text-sm/6 font-medium text-gray-900 dark:text-gray-100">Application for</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-400">Backend
                            Developer
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:pooentry.show-recent/>
        </div>
    </div>
</x-layouts::app>
