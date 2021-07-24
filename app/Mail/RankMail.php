<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class RankMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $Rank;
    public function __construct($Rank)
    {
        $this->Rank = $Rank;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = Auth::user();
       
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('mails.rank')
        ->subject('Felicidades has alcanzado una nueva meta')
        ->with(compact('user'))
        ->with($this->Rank);
    }
}
