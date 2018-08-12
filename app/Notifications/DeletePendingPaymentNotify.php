<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletePendingPaymentNotify extends Notification
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
            'title' => 'Pembayaran dibatalkan',
            'icon' => 'fa fa-usd bg-red',
            'message' => 'Pembayaran anda '.$payment->getCode().' dibatalkan, karena melebihi batas waktu pembayaran',
            'link' => url('payment')
        ];
    }
}
