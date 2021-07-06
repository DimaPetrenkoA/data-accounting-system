<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;

class OutputFilesCollisionDetected extends Notification
{
    use Queueable;

    public $filename;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DashboardChannel::class];
    }

    public function toDashboard($notifiable)
    {
        return (new DashboardMessage)
            ->title('Возникла ошибка обработки файла '.$this->filename)
            ->message('Произошла коллизия файлов при загрузке файла '.$this->filename)
            ->action(url('/'));
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
