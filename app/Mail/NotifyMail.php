<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $post_title, $post_description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post_title, $post_description)
    {
        $this->post_title = $post_title;
        $this->post_description = $post_description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.Notify')
                ->with('post_title',$this->post_title)
                ->with('post_title',$this->post_description);
    }
}
