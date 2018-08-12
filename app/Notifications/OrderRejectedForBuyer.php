<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderRejectedForBuyer extends Notification
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
            'title' => 'Pesanan dibatalkan',
            'icon' => 'fa fa-cart-arrow-down bg-red',
            'message' => 'Pesanan anda dengan kode '.$order->getCode(). ' dibatalkan karena tidak direspon oleh penjual, dan dana anda akan kami kembalikan, thanx',
            'link' => url('refund')
        ];
    }
}
