<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notifications') }}
            </h2>
            @if($unreadCount > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-midnight-blue hover:underline">
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Unread Count Badge -->
            @if($unreadCount > 0)
                <div
                    class="mb-4 p-3 bg-green-gold-50 dark:bg-green-gold-900/20 border border-green-gold-200 dark:border-green-gold-800 rounded-lg">
                    <p class="text-sm text-green-gold-800 dark:text-green-gold-200">
                        You have <span class="font-bold">{{ $unreadCount }}</span> unread
                        notification{{ $unreadCount > 1 ? 's' : '' }}
                    </p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($notifications->count() > 0)
                        <div class="space-y-3">
                            @foreach($notifications as $notification)
                                <div
                                    class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition
                                            {{ !$notification->read ? 'bg-midnight-blue-50 dark:bg-midnight-blue-900/20 border-midnight-blue-200 dark:border-midnight-blue-800' : '' }}">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $notification->title }}</h4>
                                                @if(!$notification->read)
                                                    <span class="inline-block w-2 h-2 bg-green-gold rounded-full"></span>
                                                @endif
                                                <span class="text-xs px-2 py-1 rounded capitalize
                                                            {{ $notification->type === 'support_ticket' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : '' }}
                                                            {{ $notification->type === 'schedule_request' ? 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' : '' }}
                                                        ">
                                                    {{ str_replace('_', ' ', $notification->type) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $notification->message }}</p>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-3 pt-3 border-t dark:border-gray-700">
                                        <span
                                            class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                        <div class="flex gap-2">
                                            @if($notification->action_url)
                                                <form action="{{ route('notification.read', $notification) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="text-xs px-3 py-1.5 bg-midnight-blue text-white rounded hover:bg-midnight-blue-600">
                                                        View
                                                    </button>
                                                </form>
                                            @endif
                                            @if(!$notification->read)
                                                <form action="{{ route('notification.read', $notification) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="event.preventDefault(); this.querySelector('input[name=_method]').value='PATCH'; this.submit();">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <button type="submit"
                                                        class="text-xs px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                                                        Mark as Read
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No notifications yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>