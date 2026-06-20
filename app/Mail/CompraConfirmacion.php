<?php

namespace App\Mail;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompraConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $compra;

    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Confirmación de compra - Teatro de la Ciudad',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.compra',
        );
    }
}
