<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details,$post_title, $post_description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$post_title, $post_description)
    {
        $this->details = $details;
        $this->post_title = $post_title;
        $this->post_description = $post_description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NotifyMail($this->post_title,$this->post_description);
        Mail::to($this->details['email'])->send($email);
    }
}
