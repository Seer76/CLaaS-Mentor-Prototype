<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Forum') }}
            </h2>
            <a href="{{ route('forum.create') }}"
                class="bg-green-gold hover:bg-green-gold-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + New Post
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="mb-6 flex gap-2">
                <a href="{{ route('forum.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold {{ !$category ? 'bg-midnight-blue text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    All
                </a>
                <a href="{{ route('forum.index', ['category' => 'technical_help']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold {{ $category === 'technical_help' ? 'bg-midnight-blue text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    Technical Help
                </a>
                <a href="{{ route('forum.index', ['category' => 'academic_questions']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold {{ $category === 'academic_questions' ? 'bg-midnight-blue text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    Academic Questions
                </a>
                <a href="{{ route('forum.index', ['category' => 'general']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold {{ $category === 'general' ? 'bg-midnight-blue text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    General
                </a>
            </div>

            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Posts List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($posts as $post)
                        <div class="border-b dark:border-gray-700 last:border-0 py-4 first:pt-0 last:pb-0">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <a href="{{ route('forum.show', $post) }}" class="hover:text-midnight-blue">
                                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                                            @if($post->is_pinned)
                                                <span class="text-green-gold">📌</span>
                                            @endif
                                            {{ $post->title }}
                                        </h3>
                                    </a>
                                    <div class="flex items-center gap-3 mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        <span>{{ $post->user->name }}</span>
                                        <span>•</span>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                        <span>•</span>
                                        <span class="px-2 py-1 rounded text-xs capitalize
                                                {{ $post->category === 'technical_help' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : '' }}
                                                {{ $post->category === 'academic_questions' ? 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' : '' }}
                                                {{ $post->category === 'general' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                            ">
                                            {{ str_replace('_', ' ', $post->category) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right text-sm text-gray-600 dark:text-gray-400">
                                    <div>{{ $post->all_replies_count }} {{ Str::plural('reply', $post->all_replies_count) }}
                                    </div>
                                    <div>{{ $post->views_count }} {{ Str::plural('view', $post->views_count) }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No posts yet. Be the first to start a discussion!</p>
                    @endforelse

                    @if($posts->hasPages())
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>