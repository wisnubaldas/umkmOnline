<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPendingOrderForSeller extends Notification
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $order = $this->order;

        return [
            'title' => 'Pesanan Baru ke Toko Anda',
            'icon' => 'fa fa-cart-arrow-down bg-yellow',
            'message' => 'Pesanan baru dari pembeli bernama '.$order->user->name.' dengan kode pesanan '.$order->getCode() . ' menunggu respon anda.',
            'link' => url('sales?status=1')
        ];
    }
}
