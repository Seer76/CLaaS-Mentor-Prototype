<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Skills Passport') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Overall Progress -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Overall Skills Competency</h3>
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                            <div class="bg-green-gold h-4 rounded-full" style="width: {{ $overallProgress }}%"></div>
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-green-gold">{{ number_format($overallProgress, 0) }}%</div>
                </div>
            </div>

            <!-- Quick Nav -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('learner.scorecard') }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600">
                    Grades
                </a>
                <a href="{{ route('learner.skills-passport') }}"
                    class="px-4 py-2 bg-midnight-blue text-white rounded-lg font-semibold">
                    Skills Passport
                </a>
            </div>

            <!-- Skills by Category -->
            @forelse($skillsByCategory as $category => $skills)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h3
                        class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">
                        {{ $category }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($skills as $userSkill)
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $userSkill->skill->name }}</div>
                                        <div class="text-xs text-gray-500">
                                            @if($userSkill->learningItem)
                                                From: {{ $userSkill->learningItem->title }}
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded capitalize
                                                {{ $userSkill->proficiency_level === 'expert' ? 'bg-green-gold text-white' : '' }}
                                                {{ $userSkill->proficiency_level === 'advanced' ? 'bg-midnight-blue-300 text-white' : '' }}
                                                {{ $userSkill->proficiency_level === 'intermediate' ? 'bg-green-gold-200 text-green-gold-800' : '' }}
                                                {{ $userSkill->proficiency_level === 'beginner' ? 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                            ">
                                        {{ $userSkill->proficiency_level }}
                                    </span>
                                </div>

                                <div class="mb-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Progress</span>
                                        <span>{{ $userSkill->progress_percent }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-midnight-blue h-2 rounded-full"
                                            style="width: {{ $userSkill->progress_percent }}%"></div>
                                    </div>
                                </div>

                                @if($userSkill->acquired_at)
                                    <div class="text-xs text-gray-500">
                                        Acquired: {{ $userSkill->acquired_at->format('M d, Y') }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-gray-500 text-center py-8">No skills acquired yet. Complete learning modules to earn
                        skills!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>