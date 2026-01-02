<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RutinaPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfBytes;
    public $visitante;

    public function __construct($pdfBytes, $visitante = null)
    {
        $this->pdfBytes = $pdfBytes;
        $this->visitante = $visitante;
    }

    public function build()
    {
        return $this->subject('Tu Rutina Personalizada - 17Fitness')
            ->markdown('emails.rutina_pdf')
            ->with(['visitante' => $this->visitante])
            ->attachData($this->pdfBytes, 'rutina-17fitness.pdf', [
                'mime' => 'application/pdf'
            ]);
    }
}
