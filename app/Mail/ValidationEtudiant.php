<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidationEtudiant extends Mailable
{
    use Queueable, SerializesModels;

    public $etudiant;

    public function __construct($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    public function build()
    {
        return $this->subject("Confirmation de votre inscription")
                    ->view('emails.validation_etudiant');
    }
}
