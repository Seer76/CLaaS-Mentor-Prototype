<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningPlan;
use App\Models\User;
use App\Models\Cohort;
use App\Enums\UserRole;

class DashboardController extends Controller
{
    public function learner(Request $request)
    {
        $plan = LearningPlan::where('user_id', $request->user()->id)
            ->with(['items.userProgress'])
            ->first();
        return view('learner.dashboard', compact('plan'));
    }

    public function mentor(Request $request)
    {
        $mentor = $request->user();

        // Get all learners assigned to this mentor
        $assignedLearners = LearningPlan::where('mentor_id', $mentor->id)
            ->with(['user', 'items.userProgress'])
            ->get()
            ->map(function ($plan) {
                $totalItems = $plan->items->count();
                $completedItems = $plan->items->filter(function ($item) {
                    return $item->userProgress && $item->userProgress->status === 'completed';
                })->count();

                $progressPercent = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;

                // Early intervention check
                $lastActivity = $plan->items->flatMap(function ($item) {
                    return $item->userProgress ? [$item->userProgress->updated_at] : [];
                })->max();

                $daysSinceActivity = $lastActivity ? now()->diffInDays($lastActivity) : 999;
                $needsIntervention = $progressPercent < 30 || $daysSinceActivity > 7;

                return [
                    'learner' => $plan->user,
                    'plan' => $plan,
                    'progress_percent' => $progressPercent,
                    'completed_items' => $completedItems,
                    'total_items' => $totalItems,
                    'days_since_activity' => $daysSinceActivity,
                    'needs_intervention' => $needsIntervention,
                    'last_activity' => $lastActivity,
                ];
            });

        $pendingPlans = LearningPlan::where('mentor_id', $mentor->id)
            ->where('status', 'pending')
            ->with('user')
            ->get();

        return view('mentor.dashboard', compact('assignedLearners', 'pendingPlans'));
    }

    public function manager(Request $request)
    {
        $cohorts = Cohort::withCount('users')->get();
        return view('manager.dashboard', compact('cohorts'));
    }

    public function admin(Request $request)
    {
        $stats = [
            'users' => User::count(),
            'mentors' => User::where('role', UserRole::MENTOR)->count(),
            'plans' => LearningPlan::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
