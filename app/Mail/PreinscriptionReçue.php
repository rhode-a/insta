<?php

namespace App\Mail;

use App\Models\Preinscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreinscriptionReçue extends Mailable
{
    use Queueable, SerializesModels;

    public $preinscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Preinscription $preinscription)
    {
        $this->preinscription = $preinscription;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmation de votre préinscription - T.T.G Network')
                    ->markdown('emails.preinscription.received');
    }
}
