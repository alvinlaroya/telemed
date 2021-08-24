<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Consultation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $model, $action, $from, $ref;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model, $action = 'add', $from = null, $ref = null)
    {
        $this->model = $model;
        $this->action = $action;
        $this->from = $from;
        $this->ref = $ref;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'model' => $this->model,
            'action' => $this->action,
            'to' => $notifiable,
            'from' => $this->from,
            'ref' => $this->ref
        ];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
