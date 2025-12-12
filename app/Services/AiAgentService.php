<?php

namespace App\Services;

use App\Models\User;

class AiAgentService
{
    /**
     * Propose a learning plan based on the user's role and input.
     * In a real app, this would call an LLM.
     */
    public function proposeLearningPlan(User $user, array $context = []): array
    {
        // Simulation delay
        // sleep(1);

        return [
            'overview' => "Customized Learning Path for " . $user->name,
            'goal' => 'Become a Senior Developer',
            'suggested_timeline' => '3 Months',
            'modules' => [
                [
                    'week' => 1,
                    'topic' => 'Advanced Framework Patterns',
                    'action_items' => ['Complete "Laravel Architecture" Course', 'Build a Service Provider']
                ],
                [
                    'week' => 2,
                    'topic' => 'Database Optimization',
                    'action_items' => ['Analyze Query Performance', 'Implement Indexing Strategy']
                ],
                [
                    'week' => 3,
                    'topic' => 'Security & Compliance',
                    'action_items' => ['Review OWASP Top 10', 'Implement RBAC in a demo app']
                ]
            ]
        ];
    }

    public function chat(string $message, User $user): string
    {
        // Simple mock response logic
        $message = strtolower($message);

        if (str_contains($message, 'plan')) {
            return "To view your learning plan, please navigate to the Dashboard. I can help you understand specific modules if you like.";
        }

        if (str_contains($message, 'help')) {
            return "I am here to assist you with your studies. You can ask me about course content, deadlines, or career advice.";
        }

        return "That's an interesting question about '{$message}'. As an AI Mentor, I suggest we focus on your current module.";
    }
}
