<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningItem;
use App\Models\LearningProgress;

class LearningItemController extends Controller
{
    public function updateProgress(Request $request, LearningItem $learningItem)
    {
        $request->validate([
            'status' => 'required|in:not_started,in_progress,completed'
        ]);

        $progress = LearningProgress::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'learning_item_id' => $learningItem->id,
            ],
            [
                'status' => $request->status,
                'progress_percent' => $request->status === 'completed' ? 100 : ($request->status === 'in_progress' ? 50 : 0),
                'completed_at' => $request->status === 'completed' ? now() : null,
            ]
        );

        return back()->with('status', 'Progress updated!');
    }
}
