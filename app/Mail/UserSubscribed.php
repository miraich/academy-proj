<?php

namespace App\Mail;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use function Laravel\Prompts\text;

class UserSubscribed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $receiver;
    private string $sender;
    private string $senderId;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, public Subscription $sub)
    {
        $this->receiver = auth()->user()->id;
        $this->sender = $this->user->login;
        $this->senderId = $this->user->id;
        $this->afterCommit();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'У вас новый подписчик',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.UserSubscribed',
            with: ['sender' => $this->sender,
                'receiver' => $this->receiver,
                'senderId' => $this->senderId]
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
