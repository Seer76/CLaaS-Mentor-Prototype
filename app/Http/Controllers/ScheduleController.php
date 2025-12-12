<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleAdjustmentRequest;
use App\Models\LearningItem;
use App\Models\User;
use App\Models\Notification;
use App\Enums\UserRole;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $requests = ScheduleAdjustmentRequest::where('user_id', $user->id)
            ->with(['learningItem', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('learner.schedule-requests', compact('requests'));
    }

    public function create()
    {
        $learningItems = auth()->user()->learningPlans->first()?->items ?? collect();
        return view('learner.schedule-request-create', compact('learningItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'learning_item_id' => 'nullable|exists:learning_items,id',
            'request_type' => 'required|in:deadline_extension,session_reschedule,module_swap',
            'reason' => 'required|string',
            'current_date' => 'nullable|date',
            'requested_date' => 'nullable|date|after:current_date',
        ]);

        $scheduleRequest = ScheduleAdjustmentRequest::create([
            'user_id' => $request->user()->id,
            'learning_item_id' => $request->learning_item_id,
            'request_type' => $request->request_type,
            'reason' => $request->reason,
            'current_date' => $request->current_date,
            'requested_date' => $request->requested_date,
            'status' => 'pending',
        ]);

        // Create notifications for mentors
        $mentors = User::where('role', UserRole::MENTOR)->get();
        foreach ($mentors as $mentor) {
            Notification::create([
                'user_id' => $mentor->id,
                'type' => 'schedule_request',
                'title' => 'New Schedule Adjustment Request',
                'message' => $request->user()->name . ' requests ' . str_replace('_', ' ', $request->request_type),
                'action_url' => route('mentor.schedule-requests'),
                'notifiable_type' => ScheduleAdjustmentRequest::class,
                'notifiable_id' => $scheduleRequest->id,
            ]);
        }

        return redirect()->route('learner.schedule-requests')->with('status', 'Schedule adjustment request submitted!');
    }

    public function mentorIndex()
    {
        $requests = ScheduleAdjustmentRequest::with(['user', 'learningItem', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mentor.schedule-requests', compact('requests'));
    }

    public function review(Request $request, ScheduleAdjustmentRequest $scheduleRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'review_notes' => 'nullable|string',
        ]);

        $scheduleRequest->update([
            'status' => $request->status,
            'reviewed_by' => $request->user()->id,
            'review_notes' => $request->review_notes,
            'reviewed_at' => now(),
        ]);

        // If approved and deadline extension, update the learning item due date
        if ($request->status === 'approved' && $scheduleRequest->request_type === 'deadline_extension' && $scheduleRequest->learning_item_id) {
            $scheduleRequest->learningItem->update([
                'due_date' => $scheduleRequest->requested_date,
            ]);
        }

        return back()->with('status', 'Request reviewed successfully!');
    }

    public function sessions()
    {
        $user = auth()->user();
        $plan = $user->learningPlans->first();

        $upcomingItems = $plan?->items()
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->with('userProgress')
            ->get() ?? collect();

        return view('learner.sessions', compact('upcomingItems'));
    }
}
