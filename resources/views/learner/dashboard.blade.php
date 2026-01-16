<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Learning Journey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!$plan)
                        <div class="text-center py-10">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Welcome to CLaaS!</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">You don't have a learning plan yet.</p>

                            <form action="{{ route('learning-plan.generate') }}" method="POST" class="mt-6">
                                @csrf
                                <x-primary-button>
                                    {{ __('Generate Personalized AI Plan') }}
                                </x-primary-button>
                            </form>
                            <div class="mt-4">
                                <a href="{{ route('learner.chat') }}"
                                    class="text-sm text-blue-600 dark:text-blue-400 underline">Ask AI Mentor a question</a>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-5 mb-5">
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                                    {{ $plan->title }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                    Status: <span
                                        class="capitalize font-bold {{ $plan->status === 'approved' ? 'text-green-600' : 'text-yellow-600' }}">{{ $plan->status }}</span>
                                </p>
                            </div>

                        </div>

                        {{-- Progress Bar --}}
                        @php
                            $totalItems = $plan->items->count();
                            $completedItems = $plan->items->filter(fn($i) => $i->userProgress?->status === 'completed')->count();
                            $progressPercent = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;
                        @endphp
                        <div class="mb-6">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Overall Progress</span>
                                <span>{{ $completedItems }} / {{ $totalItems }} items ({{ $progressPercent }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-midnight-blue h-2.5 rounded-full" style="width: {{ $progressPercent }}%">
                                </div>
                            </div>
                        </div>

                        {{-- Learning Items List --}}
                        <div class="space-y-4">
                            <h4 class="font-bold text-lg">Learning Modules</h4>
                            @forelse($plan->items as $item)
                                @php
                                    $status = $item->userProgress?->status ?? 'not_started';
                                    $statusColors = [
                                        'not_started' => 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100',
                                    ];
                                @endphp
                                <div
                                    class="border dark:border-gray-600 rounded-lg p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xs font-medium px-2.5 py-0.5 rounded {{ $statusColors[$status] }}">
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </span>
                                            @if($item->due_date)
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    Due: {{ $item->due_date->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <h5 class="font-semibold mt-2">{{ $item->title }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $item->description }}</p>
                                        @if($item->content_url)
                                            <a href="{{ $item->content_url }}" target="_blank"
                                                class="text-sm text-blue-600 dark:text-blue-400 underline mt-2 inline-block">
                                                Open Content →
                                            </a>
                                        @endif
                                    </div>
                                    <div class="flex gap-2 flex-shrink-0">
                                        @if($status !== 'in_progress')
                                            <form action="{{ route('learning-item.progress', $item) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs bg-green-gold text-white rounded hover:bg-green-gold-600">Start</button>
                                            </form>
                                        @endif
                                        @if($status !== 'completed')
                                            <form action="{{ route('learning-item.progress', $item) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs bg-midnight-blue text-white rounded hover:bg-midnight-blue-600">Complete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No learning modules assigned yet.</p>
                            @endforelse
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>