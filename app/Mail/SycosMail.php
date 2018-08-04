<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SycosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codeS)
    {
        $this->code = $codeS;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noReply@sycos.in')
                    ->view('emails.welcome');
    }
}
