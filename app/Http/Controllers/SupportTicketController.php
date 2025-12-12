<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\User;
use App\Enums\UserRole;

class SupportTicketController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tickets = SupportTicket::where('user_id', $user->id)
            ->with('assignedMentor')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('learner.support', compact('tickets'));
    }

    public function create()
    {
        return view('learner.support-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:platform,subject',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'open',
        ]);

        // Create notifications for mentors (subject support only)
        if ($ticket->type === 'subject') {
            $mentors = \App\Models\User::where('role', \App\Enums\UserRole::MENTOR)->get();
            foreach ($mentors as $mentor) {
                \App\Models\Notification::create([
                    'user_id' => $mentor->id,
                    'type' => 'support_ticket',
                    'title' => 'New Subject Support Request',
                    'message' => $request->user()->name . ' needs help: ' . $request->subject,
                    'action_url' => route('mentor.tickets'),
                    'notifiable_type' => SupportTicket::class,
                    'notifiable_id' => $ticket->id,
                ]);
            }
        }

        return redirect()->route('learner.support')->with('status', 'Ticket created successfully!');
    }

    public function mentorIndex(Request $request)
    {
        $tickets = SupportTicket::where('type', 'subject')
            ->with(['user', 'assignedMentor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mentor.tickets', compact('tickets'));
    }

    public function adminIndex()
    {
        $tickets = SupportTicket::where('type', 'platform')
            ->with(['user', 'assignedMentor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tickets', compact('tickets'));
    }

    public function assign(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in_progress',
        ]);

        return back()->with('status', 'Ticket assigned successfully!');
    }

    public function resolve(SupportTicket $ticket)
    {
        $ticket->update([
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);

        return back()->with('status', 'Ticket resolved!');
    }
}
