<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\RayganSms\TextMessage;
use NotificationChannels\RayganSms\RayganSmsChannel;

class AdminAuthNotification extends Notification
{
    use Queueable;

    protected $admin;

    /**
     * Create a new notification instance.
     *
     * @param $admin
     */
    public function __construct($admin)
    {
        //
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return [RayganSmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toRayganSms($notifiable)
    {
        return (new TextMessage)
            ->content(" وب سولو - کد فعال سازی:" . $this->admin->code);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
