<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LearningPlan;
use App\Models\LearningItem;
use App\Models\LearningProgress;
use App\Models\Reminder;
use App\Models\Cohort;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Staff Accounts
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@claas.com',
            'role' => UserRole::ADMIN,
            'password' => Hash::make('password'),
        ]);

        $manager = User::factory()->create([
            'name' => 'Sarah Chen',
            'email' => 'manager@claas.com',
            'role' => UserRole::MANAGER,
            'password' => Hash::make('password'),
        ]);

        $mentor = User::factory()->create([
            'name' => 'Dr. James Wilson',
            'email' => 'mentor@claas.com',
            'role' => UserRole::MENTOR,
            'password' => Hash::make('password'),
        ]);

        // Specialized Mentors
        $mentorAI = User::factory()->create([
            'name' => 'Prof. Lisa Chen',
            'email' => 'mentor.ai@claas.com',
            'role' => UserRole::MENTOR,
            'password' => Hash::make('password'),
        ]);

        $mentorData = User::factory()->create([
            'name' => 'Dr. Michael Tan',
            'email' => 'mentor.data@claas.com',
            'role' => UserRole::MENTOR,
            'password' => Hash::make('password'),
        ]);

        // Demo Learners with different progress stages
        $demoLearners = [
            // Gen AI Track
            ['name' => 'Alice Tan', 'email' => 'alice@claas.com', 'track' => 'genai', 'progress' => 'completed'],
            ['name' => 'Bob Lee', 'email' => 'bob@claas.com', 'track' => 'genai', 'progress' => 'in_progress'],
            ['name' => 'Carol Wong', 'email' => 'carol@claas.com', 'track' => 'genai', 'progress' => 'just_started'],
            ['name' => 'David Lim', 'email' => 'david@claas.com', 'track' => 'genai', 'progress' => 'not_started'],
            ['name' => 'Emma Ng', 'email' => 'emma@claas.com', 'track' => 'genai', 'progress' => 'halfway'],
            // Data Analytics Track
            ['name' => 'Frank Goh', 'email' => 'frank@claas.com', 'track' => 'data', 'progress' => 'completed'],
            ['name' => 'Grace Yeo', 'email' => 'grace@claas.com', 'track' => 'data', 'progress' => 'in_progress'],
            ['name' => 'Henry Koh', 'email' => 'henry@claas.com', 'track' => 'data', 'progress' => 'just_started'],
            ['name' => 'Ivy Teo', 'email' => 'ivy@claas.com', 'track' => 'data', 'progress' => 'not_started'],
            ['name' => 'Jack Ong', 'email' => 'jack@claas.com', 'track' => 'data', 'progress' => 'halfway'],
        ];

        // Learning Content Definitions
        $genAiModules = [
            [
                'title' => 'Introduction to Generative AI',
                'type' => 'video',
                'content_url' => 'https://www.coursera.org/learn/generative-ai-for-everyone',
                'description' => 'Understand what Generative AI is, how it works, and its applications.',
            ],
            [
                'title' => 'Prompt Engineering Fundamentals',
                'type' => 'article',
                'content_url' => 'https://platform.openai.com/docs/guides/prompt-engineering',
                'description' => 'Learn techniques for crafting effective prompts for LLMs.',
            ],
            [
                'title' => 'Building with LangChain',
                'type' => 'tutorial',
                'content_url' => 'https://python.langchain.com/docs/get_started/introduction',
                'description' => 'Hands-on guide to building AI applications using LangChain.',
            ],
            [
                'title' => 'RAG: Retrieval Augmented Generation',
                'type' => 'video',
                'content_url' => 'https://www.youtube.com/watch?v=T-D1OfcDW1M',
                'description' => 'Deep dive into RAG architecture for enterprise AI.',
            ],
            [
                'title' => 'AI Ethics & Responsible Use',
                'type' => 'article',
                'content_url' => 'https://ai.google/responsibility/responsible-ai-practices/',
                'description' => 'Best practices for ethical AI development and deployment.',
            ],
            [
                'title' => 'Capstone: Build an AI Chatbot',
                'type' => 'assignment',
                'content_url' => null,
                'description' => 'Create a functional AI chatbot using the skills learned.',
            ],
        ];

        $dataModules = [
            [
                'title' => 'Data Analytics Foundations',
                'type' => 'video',
                'content_url' => 'https://www.coursera.org/professional-certificates/google-data-analytics',
                'description' => 'Core concepts of data analytics and the data lifecycle.',
            ],
            [
                'title' => 'SQL for Data Analysis',
                'type' => 'tutorial',
                'content_url' => 'https://mode.com/sql-tutorial/',
                'description' => 'Master SQL queries for extracting insights from databases.',
            ],
            [
                'title' => 'Python for Data Science',
                'type' => 'video',
                'content_url' => 'https://www.datacamp.com/courses/intro-to-python-for-data-science',
                'description' => 'Learn Python fundamentals with pandas and numpy.',
            ],
            [
                'title' => 'Data Visualization with Tableau',
                'type' => 'tutorial',
                'content_url' => 'https://www.tableau.com/learn/training/20221',
                'description' => 'Create compelling dashboards and visualizations.',
            ],
            [
                'title' => 'Statistical Analysis & Hypothesis Testing',
                'type' => 'article',
                'content_url' => 'https://www.khanacademy.org/math/statistics-probability',
                'description' => 'Apply statistical methods to draw data-driven conclusions.',
            ],
            [
                'title' => 'Capstone: Business Intelligence Report',
                'type' => 'assignment',
                'content_url' => null,
                'description' => 'Analyze a real dataset and present actionable insights.',
            ],
        ];

        // Create Cohorts
        $genAiCohort = Cohort::create([
            'name' => 'Gen AI Fundamentals 2024',
            'manager_id' => $manager->id,
            'start_date' => now()->subMonths(2),
            'end_date' => now()->addMonth(),
        ]);

        $dataCohort = Cohort::create([
            'name' => 'Data Analytics Bootcamp 2024',
            'manager_id' => $manager->id,
            'start_date' => now()->subMonths(1),
            'end_date' => now()->addMonths(2),
        ]);

        // Create learners with plans and progress
        foreach ($demoLearners as $learnerData) {
            $user = User::factory()->create([
                'name' => $learnerData['name'],
                'email' => $learnerData['email'],
                'role' => UserRole::LEARNER,
                'password' => Hash::make('password'),
            ]);

            $isGenAi = $learnerData['track'] === 'genai';
            $modules = $isGenAi ? $genAiModules : $dataModules;
            $cohort = $isGenAi ? $genAiCohort : $dataCohort;

            // Enroll in cohort
            $cohort->users()->attach($user->id);

            // Create Learning Plan
            $plan = LearningPlan::create([
                'user_id' => $user->id,
                'mentor_id' => $mentor->id,
                'title' => $isGenAi ? 'Generative AI Mastery Path' : 'Data Analytics Professional Path',
                'status' => 'approved',
                'content' => [
                    'goal' => $isGenAi ? 'Become proficient in Gen AI development' : 'Master data analytics skills',
                    'track' => $learnerData['track'],
                ],
            ]);

            // Create Learning Items and Progress
            foreach ($modules as $index => $module) {
                $dueDate = now()->addWeeks($index + 1);

                $item = LearningItem::create([
                    'learning_plan_id' => $plan->id,
                    'title' => $module['title'],
                    'type' => $module['type'],
                    'content_url' => $module['content_url'],
                    'description' => $module['description'],
                    'due_date' => $dueDate,
                    'order' => $index,
                ]);

                // Set progress based on learner's progress stage
                $status = $this->calculateStatus($learnerData['progress'], $index, count($modules));

                if ($status !== 'not_started') {
                    LearningProgress::create([
                        'user_id' => $user->id,
                        'learning_item_id' => $item->id,
                        'status' => $status,
                        'progress_percent' => $status === 'completed' ? 100 : ($status === 'in_progress' ? 50 : 0),
                        'completed_at' => $status === 'completed' ? now()->subDays(rand(1, 30)) : null,
                    ]);
                }

                // Create reminder for incomplete items
                if ($status !== 'completed') {
                    Reminder::create([
                        'user_id' => $user->id,
                        'learning_item_id' => $item->id,
                        'remind_at' => $dueDate->subDay(),
                        'type' => 'upcoming_deadline',
                    ]);
                }
            }
        }

        // Create Courses for Assessments
        $pythonCourse = \App\Models\Course::create([
            'title' => 'Python Programming',
            'description' => 'Learn Python fundamentals',
            'difficulty' => 'beginner',
        ]);

        $dataAnalyticsCourse = \App\Models\Course::create([
            'title' => 'Data Analytics',
            'description' => 'Master data analysis techniques',
            'difficulty' => 'intermediate',
        ]);

        $aiCourse = \App\Models\Course::create([
            'title' => 'Generative AI Fundamentals',
            'description' => 'Understanding AI and LLMs',
            'difficulty' => 'intermediate',
        ]);

        // Create Assessments
        $assessments = [
            \App\Models\Assessment::create([
                'course_id' => $pythonCourse->id,
                'title' => 'Python Basics Quiz',
                'type' => 'formative',
                'max_score' => 100,
            ]),
            \App\Models\Assessment::create([
                'course_id' => $pythonCourse->id,
                'title' => 'Python Final Project',
                'type' => 'summative',
                'max_score' => 100,
            ]),
            \App\Models\Assessment::create([
                'course_id' => $dataAnalyticsCourse->id,
                'title' => 'SQL Query Challenge',
                'type' => 'formative',
                'max_score' => 100,
            ]),
            \App\Models\Assessment::create([
                'course_id' => $dataAnalyticsCourse->id,
                'title' => 'Data Visualization Project',
                'type' => 'summative',
                'max_score' => 100,
            ]),
            \App\Models\Assessment::create([
                'course_id' => $aiCourse->id,
                'title' => 'Prompt Engineering Quiz',
                'type' => 'formative',
                'max_score' => 100,
            ]),
        ];

        // Create Assessment Submissions for learners
        foreach (User::where('role', UserRole::LEARNER)->get() as $learner) {
            $submissionCount = rand(2, 5);
            foreach ($assessments as $index => $assessment) {
                if ($index < $submissionCount) {
                    \App\Models\AssessmentSubmission::create([
                        'assessment_id' => $assessment->id,
                        'user_id' => $learner->id,
                        'score' => rand(65, 98),
                        'status' => 'graded',
                        'feedback' => 'Good work! Keep practicing.',
                    ]);
                }
            }
        }

        // Create Skills Taxonomy
        $skills = [
            // Technical Skills
            ['name' => 'Python Programming', 'category' => 'Technical', 'level' => 'intermediate'],
            ['name' => 'SQL Querying', 'category' => 'Technical', 'level' => 'intermediate'],
            ['name' => 'Data Visualization', 'category' => 'Technical', 'level' => 'intermediate'],
            ['name' => 'Prompt Engineering', 'category' => 'Technical', 'level' => 'beginner'],
            ['name' => 'Machine Learning Basics', 'category' => 'Technical', 'level' => 'advanced'],
            // Soft Skills
            ['name' => 'Critical Thinking', 'category' => 'Soft Skill', 'level' => 'intermediate'],
            ['name' => 'Problem Solving', 'category' => 'Soft Skill', 'level' => 'intermediate'],
            ['name' => 'Communication', 'category' => 'Soft Skill', 'level' => 'beginner'],
            // Domain Knowledge
            ['name' => 'Statistical Analysis', 'category' => 'Domain Knowledge', 'level' => 'intermediate'],
            ['name' => 'AI Ethics', 'category' => 'Domain Knowledge', 'level' => 'beginner'],
        ];

        foreach ($skills as $skillData) {
            \App\Models\Skill::create($skillData);
        }

        // Assign Skills to Learners with varying proficiency
        $allSkills = \App\Models\Skill::all();
        foreach (User::where('role', UserRole::LEARNER)->limit(5)->get() as $learner) {
            $skillsToAssign = $allSkills->random(rand(3, 6));
            foreach ($skillsToAssign as $skill) {
                $proficiencyLevels = ['beginner', 'intermediate', 'advanced', 'expert'];
                $proficiency = $proficiencyLevels[array_rand($proficiencyLevels)];
                $progress = match ($proficiency) {
                    'expert' => rand(90, 100),
                    'advanced' => rand(70, 89),
                    'intermediate' => rand(50, 69),
                    'beginner' => rand(20, 49),
                };

                \App\Models\UserSkill::create([
                    'user_id' => $learner->id,
                    'skill_id' => $skill->id,
                    'proficiency_level' => $proficiency,
                    'progress_percent' => $progress,
                    'acquired_at' => $progress >= 80 ? now()->subDays(rand(1, 30)) : null,
                ]);
            }
        }

        // Create the original test learner (empty plan)
        User::factory()->create([
            'name' => 'Test Learner',
            'email' => 'learner@claas.com',
            'role' => UserRole::LEARNER,
            'password' => Hash::make('password'),
        ]);

        // =========================================
        // FORUM POSTS & REPLIES
        // =========================================

        $forumPost1 = \App\Models\ForumPost::create([
            'user_id' => $learners[0]->id,
            'title' => 'Help with Python List Comprehensions',
            'content' => 'I\'m struggling to understand how list comprehensions work in Python. Can someone explain with examples?',
            'category' => 'technical_help',
        ]);

        $forumPost2 = \App\Models\ForumPost::create([
            'user_id' => $learners[1]->id,
            'title' => 'What are the best resources for learning SQL?',
            'content' => 'I want to improve my SQL skills. What are some good resources or courses you would recommend?',
            'category' => 'academic_questions',
        ]);

        $forumPost3 = \App\Models\ForumPost::create([
            'user_id' => $learners[2]->id,
            'title' => 'Machine Learning Project Ideas',
            'content' => 'Looking for beginner-friendly ML project ideas to practice what I\'ve learned. Any suggestions?',
            'category' => 'general',
        ]);

        $forumPost4 = \App\Models\ForumPost::create([
            'user_id' => $learners[3]->id,
            'title' => 'Error in Pandas DataFrame merge',
            'content' => 'I\'m getting a KeyError when trying to merge two DataFrames. Here\'s my code: df.merge(df2, on=\'id\'). What am I doing wrong?',
            'category' => 'technical_help',
            'is_pinned' => true,
        ]);

        $forumPost5 = \App\Models\ForumPost::create([
            'user_id' => $mentorAI->id,
            'title' => 'Tips for Effective Prompt Engineering',
            'content' => 'As someone working with LLMs daily, here are my top 5 tips for writing better prompts...',
            'category' => 'general',
            'is_pinned' => true,
        ]);

        // Add threaded replies to Post 1 (Python List Comprehensions)
        $reply1 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost1->id,
            'user_id' => $mentorData->id,
            'content' => 'List comprehensions are a concise way to create lists. Basic syntax: [expression for item in iterable]. Example: squares = [x**2 for x in range(10)]',
        ]);

        $reply1_1 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost1->id,
            'parent_id' => $reply1->id,
            'user_id' => $learners[0]->id,
            'content' => 'Thanks! So it\'s like a for loop but in one line?',
        ]);

        $reply1_1_1 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost1->id,
            'parent_id' => $reply1_1->id,
            'user_id' => $mentorData->id,
            'content' => 'Exactly! It\'s more Pythonic and often faster than traditional loops.',
        ]);

        $reply1_2 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost1->id,
            'parent_id' => $reply1->id,
            'user_id' => $learners[4]->id,
            'content' => 'You can also add conditions: [x for x in range(10) if x % 2 == 0] for even numbers only',
        ]);

        // Add replies to Post 2 (SQL Resources)
        \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost2->id,
            'user_id' => $mentor->id,
            'content' => 'I recommend SQLZoo for interactive practice and Mode Analytics SQL Tutorial for real-world scenarios.',
        ]);

        \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost2->id,
            'user_id' => $learners[5]->id,
            'content' => 'LeetCode has great SQL problems! Start with the Easy ones.',
        ]);

        // Add replies to Post 3 (ML Project Ideas)
        $reply3 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost3->id,
            'user_id' => $mentorAI->id,
            'content' => 'Great question! Here are 3 beginner projects: 1) Iris flower classification, 2) House price prediction, 3) Sentiment analysis on tweets',
        ]);

        $reply3_1 = \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost3->id,
            'parent_id' => $reply3->id,
            'user_id' => $learners[2]->id,
            'content' => 'Thank you! I\'ll start with the Iris dataset. Is scikit-learn the best library for this?',
        ]);

        \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost3->id,
            'parent_id' => $reply3_1->id,
            'user_id' => $mentorAI->id,
            'content' => 'Yes! sklearn is perfect for beginners. Very well-documented and easy to use.',
        ]);

        // Add replies to Post 4 (Pandas Error)
        \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost4->id,
            'user_id' => $mentorData->id,
            'content' => 'Check if both DataFrames actually have a column named \'id\'. Use df.columns and df2.columns to verify.',
        ]);

        \App\Models\ForumReply::create([
            'forum_post_id' => $forumPost4->id,
            'user_id' => $learners[6]->id,
            'content' => 'I had this same issue! Make sure the column names match exactly (case-sensitive).',
        ]);

        // Increment view counts to make it realistic
        $forumPost1->update(['views_count' => 45]);
        $forumPost2->update(['views_count' => 32]);
        $forumPost3->update(['views_count' => 28]);
        $forumPost4->update(['views_count' => 67]);
        $forumPost5->update(['views_count' => 89]);
    }

    private function calculateStatus(string $progressStage, int $itemIndex, int $totalItems): string
    {
        return match ($progressStage) {
            'completed' => 'completed',
            'in_progress' => $itemIndex < $totalItems - 2 ? 'completed' : ($itemIndex === $totalItems - 2 ? 'in_progress' : 'not_started'),
            'halfway' => $itemIndex < floor($totalItems / 2) ? 'completed' : ($itemIndex === floor($totalItems / 2) ? 'in_progress' : 'not_started'),
            'just_started' => $itemIndex === 0 ? 'in_progress' : 'not_started',
            'not_started' => 'not_started',
            default => 'not_started',
        };
    }
}
