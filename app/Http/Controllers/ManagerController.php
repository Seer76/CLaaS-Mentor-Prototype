<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cohort;
use App\Models\User;
use App\Models\LearningPlan;
use App\Models\LearningProgress;
use App\Enums\UserRole;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $cohorts = Cohort::with(['users.learningPlans.items.userProgress'])
            ->withCount('users')
            ->get()
            ->map(function ($cohort) {
                // Calculate average progress per cohort
                $totalItems = 0;
                $completedItems = 0;

                foreach ($cohort->users as $user) {
                    foreach ($user->learningPlans as $plan) {
                        foreach ($plan->items as $item) {
                            $totalItems++;
                            if ($item->userProgress?->status === 'completed') {
                                $completedItems++;
                            }
                        }
                    }
                }

                $cohort->progress_percent = $totalItems > 0
                    ? round(($completedItems / $totalItems) * 100)
                    : 0;

                return $cohort;
            });

        $mentors = User::where('role', UserRole::MENTOR)->get();

        return view('manager.dashboard', compact('cohorts', 'mentors'));
    }

    public function cohortLearners(Cohort $cohort)
    {
        $learners = $cohort->users()
            ->where('role', UserRole::LEARNER)
            ->with(['learningPlans.mentor', 'learningPlans.items.userProgress'])
            ->get()
            ->map(function ($learner) {
                $plan = $learner->learningPlans->first();
                if ($plan) {
                    $totalItems = $plan->items->count();
                    $completedItems = $plan->items->filter(fn($i) => $i->userProgress?->status === 'completed')->count();
                    $learner->progress_percent = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;
                    $learner->plan = $plan;
                } else {
                    $learner->progress_percent = 0;
                    $learner->plan = null;
                }
                return $learner;
            });

        $mentors = User::where('role', UserRole::MENTOR)->get();

        return view('manager.cohort-learners', compact('cohort', 'learners', 'mentors'));
    }

    public function assignMentor(Request $request, LearningPlan $learningPlan)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id'
        ]);

        $learningPlan->update([
            'mentor_id' => $request->mentor_id
        ]);

        return back()->with('status', 'Mentor assigned successfully!');
    }
}
