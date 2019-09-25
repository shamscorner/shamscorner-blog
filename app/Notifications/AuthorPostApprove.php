<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuthorPostApprove extends Notification
{
    use Queueable;

    private $post;
    private $msg;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $msg)
    {
        $this->post = $post;
        $this->msg = $msg;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->msg == 'approved') {
            $body = 'We are happy to announce you that your post has been approved. Now you can publish your post if you haven\'t done already.';
        } else {
            $body = 'We are sorry to announce you that your post has been cancelled for violating our terms & conditions. Please recheck everything and post again.';
        }

        return (new MailMessage)
                ->greeting('Hello, '. $this->post->user->name .'!')
                ->subject('Your post has been '. $this->msg .' - ShamsCorner')
                ->line('Title: '. $this->post->title.'.')
                ->line($body)
                ->action('View', url(route('author.post.show', $this->post->id)))
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
