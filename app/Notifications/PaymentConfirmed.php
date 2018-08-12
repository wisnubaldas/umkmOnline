<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentConfirmed extends Notification
{
    use Queueable;

    public $payment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
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
        $payment = $this->payment;

        return [
            'title' => 'Pembayaran Selesai',
            'icon' => 'fa fa-usd bg-green',
            'message' => 'Pembayaran anda dengen code ' . $payment->getCode() . ' telah diterima admin kami, selanjutnya pesanan anda kami diteruskan kepada penjual.',
            'link' => url('buy')
        ];
    }
}
