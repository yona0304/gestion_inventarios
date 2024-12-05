<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Mail\Mailables\Address;


class ContactanosMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $nuevacontrase;
    /**
     * Create a new message instance.
     */
    public function __construct($nuevacontrase)
    {

        $this->nuevacontrase = $nuevacontrase;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperación de Cuenta - Nueva Contraseña',
            // from: new Address('soporte@ingicat.com', 'Soporte Técnico'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
            with: ['nuevacontrase' => $this->nuevacontrase],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
