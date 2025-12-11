<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BasketPurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct(array $mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Basket Purchased',
        );
    }

    public function build()
    {
        return $this->view('emails.basket.purchased')
        ->with([
            'user_name' => $this->mailData['user_name'],
            'user_email' => $this->mailData['user_email'],
            'basket_name' => $this->mailData['basket_name'],
            'amount' => $this->mailData['amount'],
            'snapshot' => $this->mailData['snapshot'],
            'purchase_date' => $this->mailData['purchase_date'],
        ]);
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
