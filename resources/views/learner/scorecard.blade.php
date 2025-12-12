<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Scorecard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Assessments</div>
                    <div class="text-3xl font-bold text-midnight-blue mt-2">{{ $totalSubmissions }}</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Graded</div>
                    <div class="text-3xl font-bold text-green-gold mt-2">{{ $gradedSubmissions }}</div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Average Score</div>
                    <div class="text-3xl font-bold text-midnight-blue-400 mt-2">{{ number_format($averageScore, 1) }}%
                    </div>
                </div>
            </div>

            <!-- Quick Nav -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('learner.scorecard') }}"
                    class="px-4 py-2 bg-midnight-blue text-white rounded-lg font-semibold">
                    Grades
                </a>
                <a href="{{ route('learner.skills-passport') }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600">
                    Skills Passport
                </a>
            </div>

            <!-- Grades Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Assessment Grades</h3>

                    @if($submissions->count() > 0)
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3">Assessment</th>
                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3">Score</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3 font-medium">
                                            {{ $submission->assessment->title ?? 'N/A' }}
                                            <div class="text-xs text-gray-500">
                                                {{ $submission->assessment->course->title ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="capitalize text-xs px-2 py-1 rounded {{ $submission->assessment->type === 'summative' ? 'bg-midnight-blue-100 text-midnight-blue-800 dark:bg-midnight-blue-900 dark:text-midnight-blue-300' : 'bg-green-gold-100 text-green-gold-800 dark:bg-green-gold-900 dark:text-green-gold-300' }}">
                                                {{ $submission->assessment->type ?? 'formative' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($submission->status === 'graded')
                                                <span
                                                    class="font-bold {{ $submission->score >= 70 ? 'text-green-gold' : 'text-red-600' }}">
                                                    {{ $submission->score ?? 0 }}%
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="capitalize text-xs px-2 py-1 rounded 
                                                        {{ $submission->status === 'graded' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                                        {{ $submission->status === 'submitted' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                                        {{ $submission->status === 'pending' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                                    ">
                                                {{ $submission->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-500 text-xs">
                                            {{ $submission->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 text-center py-8">No assessments submitted yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>