<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="pt-24 pb-10">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">
                        Welcome to your Poo Dashboard</h1>
                    <p class="mt-4 text-lg/8 text-gray-600 dark:text-gray-300">
                        Here you can track your poo statistics and recent entries.
                    </p>

                    <div class="mt-10">
                        <livewire:pooentry.create-form/>
                    </div>

                </div>

                <div class="mt-5">
                    <livewire:pooentry.dashboard-stats/>
                </div>
            </div>
        </div>

        <livewire:pooentry.show-recent/>
    </div>
</x-layouts::app>
