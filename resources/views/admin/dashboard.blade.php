<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-midnight-blue">{{ $stats['total_users'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Users</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-green-gold">{{ $stats['learners'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Learners</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-midnight-blue-400">{{ $stats['mentors'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Mentors</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-green-gold-400">{{ $stats['managers'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Managers</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-midnight-blue-300">{{ $stats['cohorts'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Cohorts</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-green-gold-300">{{ $stats['plans'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Learning Plans</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Quick Actions</h3>
                        <a href="{{ route('forum.index') }}"
                            class="bg-midnight-blue hover:bg-midnight-blue-600 text-white px-4 py-2 rounded text-sm font-semibold">
                            Forum
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.users') }}"
                            class="bg-midnight-blue hover:bg-midnight-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                            View All Users
                        </a>
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-green-gold hover:bg-green-gold-600 text-white px-6 py-3 rounded-lg font-semibold">
                            + Enroll New Learner
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>