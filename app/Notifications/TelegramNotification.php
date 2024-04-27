<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotification extends Notification
{
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $message = 'Peringatan! Nilai sensor berada di luar batas normal.' . PHP_EOL;
        $message .= 'Suhu: ' . $notifiable->temperature . PHP_EOL;
        $message .= 'Temperature: ' . $notifiable->ph . PHP_EOL;
        $message .= 'TDS: ' . $notifiable->tds . PHP_EOL;

        return TelegramMessage::create()->content($message);
    }
}
