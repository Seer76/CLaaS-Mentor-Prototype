<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cohort;
use App\Models\LearningPlan;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'learners' => User::where('role', UserRole::LEARNER)->count(),
            'mentors' => User::where('role', UserRole::MENTOR)->count(),
            'managers' => User::where('role', UserRole::MANAGER)->count(),
            'cohorts' => Cohort::count(),
            'plans' => LearningPlan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        $cohorts = Cohort::all();

        return view('admin.users', compact('users', 'cohorts'));
    }

    public function createUser()
    {
        $cohorts = Cohort::all();
        return view('admin.users-create', compact('cohorts'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:learner,mentor,manager,admin',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => UserRole::from($request->role),
            'password' => Hash::make('password'), // Default password
        ]);

        // Enroll in cohort if learner
        if ($request->role === 'learner' && $request->cohort_id) {
            $cohort = Cohort::find($request->cohort_id);
            $cohort->users()->attach($user->id);
        }

        return redirect()->route('admin.users')->with('status', "User {$user->name} created successfully!");
    }
}
