<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send email reminders to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reminders = Reminder::where('reminder_date', now()->toDateString())->get();

        foreach ($reminders as $reminder) {
            Mail::raw($reminder->message, function($message) use ($reminder) {
                $message->to($reminder->email)
                        ->subject('Your Reminder');
            });
        }
    }
}