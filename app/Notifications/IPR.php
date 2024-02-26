<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IPR extends Notification
{
    use Queueable;
    private $sender;
    public $iprs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $sender,$iprs)
    {
        $this->sender = $sender;
        $this->iprs  = $iprs;
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
        return (new MailMessage)
                    ->subject('New IPR')
                    ->line($this->sender->name.' '.'has submitted an IPR on The System For Your Approval')
                    ->line('Ref No:'.' '.$this->iprs->id )
                    ->action('View IPR', url('/'))
                    ->line('Thank you');
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
