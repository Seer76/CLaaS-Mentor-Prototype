<div class="border-l-2 {{ $depth > 0 ? 'ml-8 pl-4 border-gray-300 dark:border-gray-700' : 'border-transparent' }} mb-4">
    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
        <div class="prose dark:prose-invert max-w-none mb-3">
            {{ $reply->content }}
        </div>
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                <span class="font-medium">{{ $reply->user->name }}</span>
                <span>•</span>
                <span>{{ $reply->created_at->format('M d, Y h:i A') }}</span>
                <span>•</span>
                <span>User ID: {{ $reply->user_id }}</span>
            </div>
            <button onclick="toggleReplyForm({{ $reply->id }})"
                class="text-midnight-blue hover:underline text-xs font-semibold">
                Reply
            </button>
        </div>

        <!-- Nested Reply Form -->
        <div id="reply-form-{{ $reply->id }}" class="hidden mt-4 pt-4 border-t dark:border-gray-600">
            <form action="{{ route('forum.reply', $post) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                <textarea name="content" rows="3"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                    placeholder="Write your reply..." required></textarea>
                <x-primary-button class="mt-2">
                    {{ __('Post Reply') }}
                </x-primary-button>
                <button type="button" onclick="toggleReplyForm({{ $reply->id }})"
                    class="ml-2 text-sm text-gray-600 dark:text-gray-400 underline">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <!-- Nested Replies (Recursive) -->
    @if($reply->children && $reply->children->count() > 0)
        <div class="mt-2">
            @foreach($reply->children as $childReply)
                @include('forum.partials.reply', ['reply' => $childReply, 'post' => $post, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</div>

@once
    @push('scripts')
        <script>
            function toggleReplyForm(replyId) {
                const form = document.getElementById('reply-form-' + replyId);
                form.classList.toggle('hidden');
            }
        </script>
    @endpush
@endonce