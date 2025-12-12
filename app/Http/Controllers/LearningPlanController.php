<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LearningPlan;
use App\Models\LearningItem;
use App\Models\Reminder;
use App\Services\AiAgentService;

class LearningPlanController extends Controller
{
    public function store(Request $request, AiAgentService $aiService)
    {
        $planData = $aiService->proposeLearningPlan($request->user());

        $plan = LearningPlan::create([
            'user_id' => $request->user()->id,
            'title' => $planData['overview'],
            'status' => 'draft',
            'content' => $planData,
        ]);

        // Create LearningItems from modules
        $order = 0;
        foreach ($planData['modules'] as $module) {
            $dueDate = now()->addWeeks($module['week']);

            $item = LearningItem::create([
                'learning_plan_id' => $plan->id,
                'title' => $module['topic'],
                'type' => 'module',
                'description' => implode("\n", $module['action_items']),
                'due_date' => $dueDate,
                'order' => $order++,
            ]);

            // Schedule a reminder 1 day before due date
            Reminder::create([
                'user_id' => $request->user()->id,
                'learning_item_id' => $item->id,
                'remind_at' => $dueDate->subDay(),
                'type' => 'upcoming_deadline',
            ]);
        }

        return back()->with('status', 'AI has generated a new Learning Plan for you!');
    }

    public function approve(LearningPlan $learningPlan)
    {
        // Add authorization check here if needed (e.g., policy)

        $learningPlan->update([
            'status' => 'approved',
            'mentor_id' => auth()->id(), // Assign reviewing mentor
        ]);

        return back()->with('status', 'Learning Plan Approved!');
    }
}
