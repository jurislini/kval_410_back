<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;

    /**
     * Create a new message instance.
     *
     * @param $reminder
     */
    public function __construct($reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reminder')
                    ->with([
                        'title' => $this->reminder->title,
                        'description' => $this->reminder->description,
                        'date' => $this->reminder->date,
                        'latitude' => $this->reminder->latitude,
                        'longitude' => $this->reminder->longitude,
                    ]);
    }
}