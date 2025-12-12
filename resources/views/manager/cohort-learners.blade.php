<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('manager.dashboard') }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                ← Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $cohort->name }} - Learners
            </h2>
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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm">
                        <thead
                            class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Learner</th>
                                <th class="px-6 py-4">Progress</th>
                                <th class="px-6 py-4">Assigned Mentor</th>
                                <th class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($learners as $learner)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <div class="font-medium">{{ $learner->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $learner->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div class="h-2 rounded-full {{ $learner->progress_percent >= 75 ? 'bg-green-500' : ($learner->progress_percent >= 40 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                    style="width: {{ $learner->progress_percent }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium">{{ $learner->progress_percent }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($learner->plan?->mentor)
                                            <span class="text-purple-600 dark:text-purple-400 font-medium">
                                                {{ $learner->plan->mentor->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">Not assigned</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($learner->plan)
                                            <form action="{{ route('manager.plan.assign-mentor', $learner->plan) }}"
                                                method="POST" class="flex items-center gap-2">
                                                @csrf @method('PATCH')
                                                <select name="mentor_id"
                                                    class="text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                                                    <option value="">Select Mentor</option>
                                                    @foreach($mentors as $mentor)
                                                        <option value="{{ $mentor->id }}" {{ $learner->plan->mentor_id == $mentor->id ? 'selected' : '' }}>
                                                            {{ $mentor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-500">
                                                    Assign
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm">No plan yet</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No learners in this cohort.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>