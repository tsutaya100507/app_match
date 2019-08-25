<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Application;
use App\Models\Message;


class PostSent extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $room_url)
    {
        \Log::info($user);
        // \Log::info($message);
        // $this->message = $message;
        $this->user = $user;
        $this->url  = $room_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.applications.sents')
                    ->with([
                        'text' => $this->url,
                    ]);
    }
}
