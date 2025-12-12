<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Learning Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-6 text-gray-900 dark:text-gray-100">Upcoming Learning Milestones</h3>
                    
                    @if($upcomingItems->count() > 0)
                        <div class="space-y-3">
                            @foreach($upcomingItems as $item)
                                @php
                                    $status = $item->userProgress?->status ?? 'not_started';
                                    $daysUntil = $item->due_date ? now()->diffInDays($item->due_date, false) : null;
                                @endphp
                                <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->title }}</h4>
                                                <span class="text-xs px-2 py-1 rounded capitalize
                                                    {{ $status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                    {{ $status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                    {{ $status === 'not_started' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                                ">
                                                    {{ str_replace('_', ' ', $status) }}
                                                </span>
                                            </div>
                                            @if($item->description)
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $item->description }}</p>
                                            @endif
                                            @if($item->content_url)
                                                <a href="{{ $item->content_url }}" target="_blank" class="text-xs text-midnight-blue hover:underline">
                                                    View Content →
                                                </a>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            @if($item->due_date)
                                                <div class="text-sm font-medium
                                                    {{ $daysUntil < 0 ? 'text-red-600' : ($daysUntil <= 3 ? 'text-yellow-600' : 'text-gray-600 dark:text-gray-400') }}
                                                ">
                                                    {{ $item->due_date->format('M d, Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    @if($daysUntil < 0)
                                                        Overdue by {{ abs($daysUntil) }} days
                                                    @elseif($daysUntil == 0)
                                                        Due today!
                                                    @else
                                                        In {{ $daysUntil }} days
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No upcoming sessions scheduled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
