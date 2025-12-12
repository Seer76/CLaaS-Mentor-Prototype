<div class="flex flex-col h-[600px] border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
    <!-- Chat Header -->
    <div class="bg-gray-100 dark:bg-gray-700 p-4 border-b border-gray-300 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">AI Mentor</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Always here to help</p>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 p-4 overflow-y-auto bg-white dark:bg-gray-800 space-y-4">
        @foreach($messages as $msg)
            <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[75%] rounded-lg px-4 py-2 
                        {{ $msg['role'] === 'user'
            ? 'bg-blue-600 text-white rounded-br-none'
            : 'bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-bl-none' }}">
                    {{ $msg['content'] }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input Area -->
    <div class="p-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-300 dark:border-gray-600">
        <form wire:submit.prevent="sendMessage" class="flex gap-2">
            <input type="text" wire:model="input"
                class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Ask me anything...">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 disabled:opacity-50 transition"
                wire:loading.attr="disabled">
                Send
            </button>
        </form>
    </div>
</div>