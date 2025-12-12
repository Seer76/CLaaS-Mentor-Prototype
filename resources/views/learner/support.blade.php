<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Support') }}
            </h2>
            <a href="{{ route('learner.support.create') }}" class="bg-green-gold hover:bg-green-gold-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Create Ticket
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
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">My Tickets</h3>
                    
                    @if($tickets->count() > 0)
                        <div class="space-y-4">
                            @foreach($tickets as $ticket)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $ticket->subject }}</h4>
                                                <span class="text-xs px-2 py-1 rounded capitalize
                                                    {{ $ticket->type === 'platform' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' }}
                                                ">
                                                    {{ $ticket->type }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $ticket->description }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs px-2 py-1 rounded capitalize
                                                {{ $ticket->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                {{ $ticket->status === 'open' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                            ">
                                                {{ $ticket->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                                        <span>Priority: <span class="capitalize font-medium">{{ $ticket->priority }}</span></span>
                                        <span>{{ $ticket->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if($ticket->assignedMentor)
                                        <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                                            Assigned to: <span class="font-medium">{{ $ticket->assignedMentor->name }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No support tickets yet. Create one if you need help!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
