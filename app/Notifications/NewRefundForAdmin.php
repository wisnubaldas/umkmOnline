<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRefundForAdmin extends Notification
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
            'title' => 'Tagihan Pengembalian Dana',
            'icon' => 'fa fa-usd bg-yellow',
            'message' => 'Tagihan dari Pembeli '.$order->user->name. ' untuk pesanan '.$order->getCode().' yang dibatalkan. Menunggu respon anda (admin/operator)',
            'link' => url('admin/refund')
        ];
    }
}
