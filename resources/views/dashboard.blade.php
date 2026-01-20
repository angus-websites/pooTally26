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
                <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
                        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
                            Total Poos Logged
                        </dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            100
                        </dd>
                    </div>
                    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
                        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
                            Total Poos (Last 7 days)
                        </dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            6
                        </dd>
                    </div>
                    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
                        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
                            Total Poos (This Month)
                        </dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            24
                        </dd>
                    </div>
                    <div class="flex flex-col bg-gray-400/5 p-8 dark:bg-white/5">
                        <dt class="text-sm/6 font-semibold text-gray-600 dark:text-gray-300">
                            Average Poos Per day
                        </dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            1.2
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <livewire:pooentry.show-recent/>
    </div>
</x-layouts::app>
