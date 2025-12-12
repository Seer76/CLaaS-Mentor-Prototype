<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Support Tickets') }}
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
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Subject Support Tickets</h3>

                    @forelse($tickets as $ticket)
                        <div class="border dark:border-gray-700 rounded-lg p-4 mb-4 last:mb-0">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $ticket->subject }}
                                        </h4>
                                        <span class="text-xs px-2 py-1 rounded capitalize
                                                {{ $ticket->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                                {{ $ticket->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                {{ $ticket->priority === 'low' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                            ">
                                            {{ $ticket->priority }}
                                        </span>
                                        <span class="text-xs px-2 py-1 rounded capitalize
                                                {{ $ticket->status === 'open' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : '' }}
                                                {{ $ticket->status === 'in_progress' ? 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' : '' }}
                                                {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                            ">
                                            {{ str_replace('_', ' ', $ticket->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $ticket->user->name }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $ticket->description }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t dark:border-gray-700">
                                <span class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</span>
                                <div class="flex gap-2">
                                    @if($ticket->status !== 'in_progress' && $ticket->status !== 'resolved')
                                        <form action="{{ route('ticket.assign', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 bg-green-gold hover:bg-green-gold-600 text-white rounded font-semibold">
                                                Assign to Me
                                            </button>
                                        </form>
                                    @endif
                                    @if($ticket->status === 'in_progress')
                                        <form action="{{ route('ticket.resolve', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 bg-midnight-blue hover:bg-midnight-blue-600 text-white rounded font-semibold">
                                                Mark Resolved
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No subject support tickets yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>