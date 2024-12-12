<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpiredSubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Subscription $subscription)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subscription = $this->subscription;

        return (new MailMessage)
            ->line("{$subscription->subscription_end_data} نود إعلامك بأن اشتراكك الحالي في موقع وفرنا قد انتهى اليوم بتاريخ " )
            ->line(" لضمان استمرار الاستفادة من جميع مزايا وخدمات الموقع دون انقطاع، نوصيك بتجديد اشتراكك")
            ->line('شكرًا لاختيارك موقع وفرنا');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
