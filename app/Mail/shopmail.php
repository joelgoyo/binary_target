<?php

namespace App\Mail;

use App\Models\OrdenPurchases;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class shopmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $shop;
    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        $user = Auth::user();
        $orden = OrdenPurchases::where('iduser', Auth::id())->orderby('created_at','DESC')->first();
       
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('mails.shop')
        ->subject('Se ha realizado una compra')
        ->with(compact('user','orden'))
        ->with($this->shop);
    }
}
