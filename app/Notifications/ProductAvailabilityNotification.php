<?php

namespace App\Notifications;

use App\Models\WaitingProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ProductAvailabilityNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected WaitingProduct $waiting_product)
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
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        $waiting_product = $this->waiting_product;

        return new DatabaseMessage([
            'title' => 'المنتج : ' . $waiting_product->name ,
            'body'  => "{$waiting_product->provider->name} تم توفير المنتج {$waiting_product->name} الذي طلبته من قبل التاجر ",
            'image' => '',
            'link' =>  route('whatsapp', ['phone' => $waiting_product->provider->phone , 'message' => 'مرحبا أنا أتواصل معك من موقع وفرنا واريد الاستفسار منك عن المنتج الذي توفره']),
        ]);

    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $waiting_product = $this->waiting_product;

        return new BroadcastMessage([

            'title' => 'المنتج : ' . $waiting_product->name ,
            'body'  => "{$waiting_product->provider->name} تم توفير المنتج {$waiting_product->name} الذي طلبته من قبل التاجر ",
            'image' => '',
            'link' =>  route('whatsapp', ['phone' => $waiting_product->provider->phone , 'message' => 'مرحبا أنا أتواصل معك من موقع اعماركم واريد الاستفسار منك عن الخدمة التي تقدمها']),

        ]);
                    
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
