<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SplSubject;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    private $cart;
    private $products;
    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($data, $cart, $products)
    {
        $this->data = $data;
        $this->cart = $cart;
        $this->products = $products;
    }

    public function build()
    {
        return $this->from('nguyenminhhai120@gmail.com', "test")
        ->subject($this->data['subject'])
        ->view("emails.index")
        ->with([
            'data'=> $this->data,
            'cart'=> $this->cart,
            'products'=> $this->products,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Notify',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.index',
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
