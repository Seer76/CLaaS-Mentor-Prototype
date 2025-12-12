<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Quick Actions at Top -->
            <div class="flex gap-4">
                <a href="{{ route('mentor.tickets') }}"
                    class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Support Tickets</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage learner support requests</p>
                </a>
                <a href="{{ route('mentor.schedule-requests') }}"
                    class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Schedule Requests</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Review adjustment requests</p>
                </a>
                <a href="{{ route('mentor.notifications') }}"
                    class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">Notifications</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">View all notifications</p>
                </a>
            </div>

            <!-- Pending Plans Section -->
            @if($pendingPlans->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Pending Learning Plans</h3>
                        <div class="space-y-3">
                            @foreach($pendingPlans as $plan)
                                <div class="border dark:border-gray-700 rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <h4 class="font-semibold">{{ $plan->user->name }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $plan->title }}</p>
                                    </div>
                                    <form action="{{ route('learning-plan.approve', $plan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-green-gold hover:bg-green-gold-600 text-white px-4 py-2 rounded text-sm font-semibold">
                                            Approve
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- My Learners Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">My Learners
                            ({{ $assignedLearners->count() }})</h3>
                        <a href="{{ route('forum.index') }}"
                            class="text-sm bg-midnight-blue hover:bg-midnight-blue-600 text-white px-4 py-2 rounded font-semibold">
                            Forum
                        </a>
                    </div>

                    @forelse($assignedLearners as $data)
                        <div
                            class="border dark:border-gray-700 rounded-lg p-4 mb-4 last:mb-0
                                    {{ $data['needs_intervention'] ? 'border-red-500 dark:border-red-700 bg-red-50 dark:bg-red-900/20' : '' }}">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $data['learner']->name }}
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $data['learner']->email }}</p>
                                </div>
                                @if($data['needs_intervention'])
                                    <span class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded">
                                        ⚠️ Early Intervention Needed
                                    </span>
                                @endif
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-700 dark:text-gray-300">Progress</span>
                                    <span class="font-semibold">{{ $data['completed_items'] }} / {{ $data['total_items'] }}
                                        items ({{ $data['progress_percent'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="h-3 rounded-full {{ $data['progress_percent'] >= 70 ? 'bg-green-gold' : ($data['progress_percent'] >= 30 ? 'bg-green-gold-300' : 'bg-red-500') }}"
                                        style="width: {{ $data['progress_percent'] }}%"></div>
                                </div>
                            </div>

                            <!-- Activity Status -->
                            <div class="flex justify-between items-center text-sm">
                                <div class="text-gray-600 dark:text-gray-400">
                                    @if($data['last_activity'])
                                        Last activity: {{ $data['last_activity']->diffForHumans() }}
                                        @if($data['days_since_activity'] > 7)
                                            <span class="text-red-600 font-semibold">(Inactive for
                                                {{ $data['days_since_activity'] }} days)</span>
                                        @endif
                                    @else
                                        <span class="text-red-600">No activity yet</span>
                                    @endif
                                </div>
                                <a href="{{ route('learner.dashboard') }}"
                                    class="text-midnight-blue hover:underline font-medium">
                                    View Plan →
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No learners assigned yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>