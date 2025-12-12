<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule Adjustment Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Pending Requests</h3>

                    @forelse($requests as $request)
                        <div class="border dark:border-gray-700 rounded-lg p-4 mb-4 last:mb-0">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $request->user->name }}</h4>
                                        <span class="text-xs px-2 py-1 rounded capitalize
                                                {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                {{ $request->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                {{ $request->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                            ">
                                            {{ $request->status }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        Type: <span
                                            class="font-medium">{{ str_replace('_', ' ', ucfirst($request->request_type)) }}</span>
                                    </p>
                                    @if($request->learningItem)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            Item: <span class="font-medium">{{ $request->learningItem->title }}</span>
                                        </p>
                                    @endif
                                    @if($request->current_date && $request->requested_date)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            {{ \Carbon\Carbon::parse($request->current_date)->format('M d, Y') }} →
                                            {{ \Carbon\Carbon::parse($request->requested_date)->format('M d, Y') }}
                                        </p>
                                    @endif
                                    <p class="text-sm text-gray-700 dark:text-gray-300">Reason: {{ $request->reason }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t dark:border-gray-700">
                                <span class="text-xs text-gray-500">{{ $request->created_at->diffForHumans() }}</span>
                                @if($request->status === 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('schedule-request.review', $request) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 bg-green-gold hover:bg-green-gold-600 text-white rounded font-semibold">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('schedule-request.review', $request) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded font-semibold">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No schedule adjustment requests yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>