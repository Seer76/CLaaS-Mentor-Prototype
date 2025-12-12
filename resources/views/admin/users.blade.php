<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}"
                class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Enroll New Learner
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

            <!-- Role Filter -->
            <div class="mb-6 flex gap-2">
                <a href="{{ route('admin.users') }}"
                    class="px-4 py-2 rounded-lg text-sm {{ !request('role') ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    All
                </a>
                @foreach(\App\Enums\UserRole::cases() as $role)
                    <a href="{{ route('admin.users', ['role' => $role->value]) }}"
                        class="px-4 py-2 rounded-lg text-sm {{ request('role') === $role->value ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                        {{ $role->label() }}
                    </a>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm">
                        <thead
                            class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Cohort</th>
                                <th class="px-6 py-4">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded text-xs font-medium
                                                {{ $user->role === \App\Enums\UserRole::ADMIN ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                                {{ $user->role === \App\Enums\UserRole::MANAGER ? 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300' : '' }}
                                                {{ $user->role === \App\Enums\UserRole::MENTOR ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' : '' }}
                                                {{ $user->role === \App\Enums\UserRole::LEARNER ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                            ">
                                            {{ $user->role->label() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->role === \App\Enums\UserRole::LEARNER)
                                            {{ $user->cohorts->first()?->name ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>