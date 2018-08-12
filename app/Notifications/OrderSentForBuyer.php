<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSentForBuyer extends Notification
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
            'title' => 'Pesanan Telah Dikirim',
            'icon' => 'fa fa-cart-arrow-down bg-blue',
            'message' => 'Pesanan anda dengan kode '.$order->getCode(). ' telah Dikirim oleh penjual dengan nomor Resi JNE '.$order->resi_number.', thanx.',
            'link' => url('buy')
        ];
    }
}
