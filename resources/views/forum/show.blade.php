<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $post->title }}
            </h2>
            <a href="{{ route('forum.index') }}" class="text-sm text-midnight-blue hover:underline">← Back to Forum</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Original Post -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="px-3 py-1 rounded text-sm capitalize
                                {{ $post->category === 'technical_help' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : '' }}
                                {{ $post->category === 'academic_questions' ? 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' : '' }}
                                {{ $post->category === 'general' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                            ">
                                {{ str_replace('_', ' ', $post->category) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500">{{ $post->views_count }}
                            {{ Str::plural('view', $post->views_count) }}</div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none mb-4">
                        {{ $post->content }}
                    </div>

                    <div
                        class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400 pt-4 border-t dark:border-gray-700">
                        <span class="font-medium">{{ $post->user->name }}</span>
                        <span>•</span>
                        <span>{{ $post->created_at->format('M d, Y h:i A') }}</span>
                        <span>•</span>
                        <span>User ID: {{ $post->user_id }}</span>
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 dark:text-gray-100">Post a Reply</h3>
                    <form action="{{ route('forum.reply', $post) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="4"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            placeholder="Write your reply..." required></textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        <x-primary-button class="mt-3">
                            {{ __('Post Reply') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Replies (Threaded) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 dark:text-gray-100">
                        {{ $post->allReplies->count() }} {{ Str::plural('Reply', $post->allReplies->count()) }}
                    </h3>

                    @forelse($post->replies as $reply)
                        @include('forum.partials.reply', ['reply' => $reply, 'post' => $post, 'depth' => 0])
                    @empty
                        <p class="text-gray-500 text-center py-4">No replies yet. Be the first to reply!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>