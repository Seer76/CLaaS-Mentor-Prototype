<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        \App\Enums\UserRole::ADMIN => redirect()->route('admin.dashboard'),
        \App\Enums\UserRole::MANAGER => redirect()->route('manager.dashboard'),
        \App\Enums\UserRole::MENTOR => redirect()->route('mentor.dashboard'),
        \App\Enums\UserRole::LEARNER => redirect()->route('learner.dashboard'),
        default => view('dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Routes
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');

    // Manager Routes
    Route::get('/manager/dashboard', [\App\Http\Controllers\ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/cohort/{cohort}/learners', [\App\Http\Controllers\ManagerController::class, 'cohortLearners'])->name('manager.cohort.learners');
    Route::patch('/manager/plan/{learningPlan}/assign-mentor', [\App\Http\Controllers\ManagerController::class, 'assignMentor'])->name('manager.plan.assign-mentor');

    // Mentor Routes
    Route::get('/mentor/dashboard', [\App\Http\Controllers\DashboardController::class, 'mentor'])->name('mentor.dashboard');

    // Learner Routes
    Route::get('/learner/dashboard', [\App\Http\Controllers\DashboardController::class, 'learner'])->name('learner.dashboard');
    Route::get('/learner/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('learner.chat');
    Route::get('/learner/scorecard', [\App\Http\Controllers\ScorecardController::class, 'index'])->name('learner.scorecard');
    Route::get('/learner/skills-passport', [\App\Http\Controllers\ScorecardController::class, 'skillsPassport'])->name('learner.skills-passport');
    Route::get('/learner/support', [\App\Http\Controllers\SupportTicketController::class, 'index'])->name('learner.support');
    Route::get('/learner/support/create', [\App\Http\Controllers\SupportTicketController::class, 'create'])->name('learner.support.create');
    Route::post('/learner/support', [\App\Http\Controllers\SupportTicketController::class, 'store'])->name('learner.support.store');
    Route::get('/learner/schedule-requests', [\App\Http\Controllers\ScheduleController::class, 'index'])->name('learner.schedule-requests');
    Route::get('/learner/schedule-requests/create', [\App\Http\Controllers\ScheduleController::class, 'create'])->name('learner.schedule-requests.create');
    Route::post('/learner/schedule-requests', [\App\Http\Controllers\ScheduleController::class, 'store'])->name('learner.schedule-requests.store');
    Route::get('/learner/sessions', [\App\Http\Controllers\ScheduleController::class, 'sessions'])->name('learner.sessions');

    // Mentor Ticket Routes
    Route::get('/mentor/tickets', [\App\Http\Controllers\SupportTicketController::class, 'mentorIndex'])->name('mentor.tickets');
    Route::get('/mentor/schedule-requests', [\App\Http\Controllers\ScheduleController::class, 'mentorIndex'])->name('mentor.schedule-requests');
    Route::get('/mentor/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('mentor.notifications');
    Route::patch('/ticket/{ticket}/assign', [\App\Http\Controllers\SupportTicketController::class, 'assign'])->name('ticket.assign');
    Route::patch('/ticket/{ticket}/resolve', [\App\Http\Controllers\SupportTicketController::class, 'resolve'])->name('ticket.resolve');
    Route::patch('/schedule-request/{scheduleRequest}/review', [\App\Http\Controllers\ScheduleController::class, 'review'])->name('schedule-request.review');
    Route::patch('/notification/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    // Admin Ticket Routes
    Route::get('/admin/tickets', [\App\Http\Controllers\SupportTicketController::class, 'adminIndex'])->name('admin.tickets');

    // Forum Routes (accessible to all authenticated users)
    Route::get('/forum', [\App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [\App\Http\Controllers\ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [\App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [\App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{post}/reply', [\App\Http\Controllers\ForumController::class, 'storeReply'])->name('forum.reply');

    // Learning Plan Routes
    Route::post('/learning-plan/generate', [\App\Http\Controllers\LearningPlanController::class, 'store'])->name('learning-plan.generate');
    Route::patch('/learning-plan/{learningPlan}/approve', [\App\Http\Controllers\LearningPlanController::class, 'approve'])->name('learning-plan.approve');
    Route::patch('/learning-item/{learningItem}/progress', [\App\Http\Controllers\LearningItemController::class, 'updateProgress'])->name('learning-item.progress');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
