<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Schedule Adjustment Requests') }}
            </h2>
            <a href="{{ route('learner.schedule-requests.create') }}" class="bg-green-gold hover:bg-green-gold-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Request Adjustment
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">My Requests</h3>
                    
                    @if($requests->count() > 0)
                        <div class="space-y-4">
                            @foreach($requests as $scheduleRequest)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 capitalize">
                                                    {{ str_replace('_', ' ', $scheduleRequest->request_type) }}
                                                </h4>
                                                <span class="text-xs px-2 py-1 rounded capitalize
                                                    {{ $scheduleRequest->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                    {{ $scheduleRequest->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                                    {{ $scheduleRequest->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                ">
                                                    {{ $scheduleRequest->status }}
                                                </span>
                                            </div>
                                            @if($scheduleRequest->learningItem)
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    Module: {{ $scheduleRequest->learningItem->title }}
                                                </p>
                                            @endif
                                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">{{ $scheduleRequest->reason }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($scheduleRequest->current_date && $scheduleRequest->requested_date)
                                        <div class="flex gap-4 text-xs text-gray-600 dark:text-gray-400 mt-2">
                                            <span>Current: {{ $scheduleRequest->current_date->format('M d, Y') }}</span>
                                            <span>→</span>
                                            <span>Requested: {{ $scheduleRequest->requested_date->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($scheduleRequest->reviewer)
                                        <div class="mt-2 pt-2 border-t dark:border-gray-700 text-xs">
                                            <span class="text-gray-500">Reviewed by {{ $scheduleRequest->reviewer->name }} {{ $scheduleRequest->reviewed_at?->diffForHumans() }}</span>
                                            @if($scheduleRequest->review_notes)
                                                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $scheduleRequest->review_notes }}</p>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div class="text-xs text-gray-500 mt-2">
                                        Requested {{ $scheduleRequest->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No schedule adjustment requests yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
