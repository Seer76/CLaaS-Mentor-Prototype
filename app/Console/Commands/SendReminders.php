<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send all due reminders';

    public function handle()
    {
        $dueReminders = Reminder::where('is_sent', false)
            ->where('remind_at', '<=', now())
            ->with(['user', 'learningItem'])
            ->get();

        $count = 0;
        foreach ($dueReminders as $reminder) {
            // In a real app, send email/notification here
            // For now, just log it
            $this->info("Reminder for {$reminder->user->name}: {$reminder->learningItem->title} is due soon!");

            $reminder->update(['is_sent' => true]);
            $count++;
        }

        $this->info("Sent {$count} reminders.");
        return Command::SUCCESS;
    }
}
