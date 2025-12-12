<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request Schedule Adjustment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('learner.schedule-requests.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="request_type" :value="__('Request Type')" />
                            <select id="request_type" name="request_type"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                required>
                                <option value="">Select Type</option>
                                <option value="deadline_extension">Deadline Extension</option>
                                <option value="session_reschedule">Session Reschedule</option>
                                <option value="module_swap">Module Swap</option>
                            </select>
                            <x-input-error :messages="$errors->get('request_type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="learning_item_id" :value="__('Related Module (Optional)')" />
                            <select id="learning_item_id" name="learning_item_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <option value="">-- Select Module --</option>
                                @foreach($learningItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('learning_item_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="current_date" :value="__('Current Date')" />
                            <x-text-input id="current_date" name="current_date" type="date" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('current_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="requested_date" :value="__('Requested Date')" />
                            <x-text-input id="requested_date" name="requested_date" type="date"
                                class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('requested_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="reason" :value="__('Reason for Request')" />
                            <textarea id="reason" name="reason" rows="5"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                required></textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Submit Request') }}
                            </x-primary-button>
                            <a href="{{ route('learner.schedule-requests') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>