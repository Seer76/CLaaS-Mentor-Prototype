<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Cohort Management</h3>
                <a href="{{ route('forum.index') }}"
                    class="bg-midnight-blue hover:bg-midnight-blue-600 text-white px-4 py-2 rounded text-sm font-semibold">
                    Forum
                </a>
            </div>
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Cohort Overview</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($cohorts as $cohort)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $cohort->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $cohort->users_count }} Learners
                                    </p>
                                </div>
                                <span
                                    class="bg-midnight-blue-100 text-midnight-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-midnight-blue-900 dark:text-midnight-blue-300">
                                    Active
                                </span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Overall Progress</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-gray-100">{{ $cohort->progress_percent }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="h-3 rounded-full {{ $cohort->progress_percent >= 75 ? 'bg-green-gold' : ($cohort->progress_percent >= 40 ? 'bg-green-gold-300' : 'bg-midnight-blue-300') }}"
                                        style="width: {{ $cohort->progress_percent }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">Start Date</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $cohort->start_date?->format('M d, Y') ?? 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">End Date</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $cohort->end_date?->format('M d, Y') ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('manager.cohort.learners', $cohort) }}"
                                class="inline-flex items-center text-midnight-blue dark:text-midnight-blue-300 hover:underline text-sm font-medium">
                                View Learners →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>