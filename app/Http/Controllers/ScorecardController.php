<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentSubmission;
use App\Models\LearningPlan;

class ScorecardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Get assessment submissions
        $submissions = AssessmentSubmission::where('user_id', $user->id)
            ->with('assessment.course')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate stats
        $totalSubmissions = $submissions->count();
        $gradedSubmissions = $submissions->where('status', 'graded')->count();
        $averageScore = $submissions->where('status', 'graded')->avg('score') ?? 0;

        return view('learner.scorecard', compact('submissions', 'totalSubmissions', 'gradedSubmissions', 'averageScore'));
    }

    public function skillsPassport(Request $request)
    {
        $user = $request->user();

        $userSkills = \App\Models\UserSkill::where('user_id', $user->id)
            ->with(['skill', 'learningItem'])
            ->orderBy('acquired_at', 'desc')
            ->get();

        // Group by category
        $skillsByCategory = $userSkills->groupBy(function ($item) {
            return $item->skill->category ?? 'General';
        });

        $overallProgress = $userSkills->avg('progress_percent') ?? 0;

        return view('learner.skills-passport', compact('skillsByCategory', 'overallProgress'));
    }
}
