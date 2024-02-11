<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifySubscribed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $sender;
    private int $senderId;
    private string $receiver;
    private string $post_title;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user,
                                public Post $post)
    {
        $this->sender = $this->post->user->login;
        $this->senderId = $this->post->user->id;
        $this->receiver = $this->user->login;
        $this->post_title = $this->post->title;
        $this->afterCommit();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Новая публикация от пользователя $this->sender",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.NotifySubscribed',
            with: ['sender' => $this->sender,
                'receiver' => $this->receiver,
                'title' => $this->post_title,
                'senderId' => $this->senderId
            ]
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
