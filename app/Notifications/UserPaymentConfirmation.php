<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPaymentConfirmation extends Notification
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
            'title' => 'Konfirmasi Pembayaran Masuk',
            'icon' => 'fa fa-usd bg-blue',
            'message' => $payment->user->name . ' Telah melakukan konfirmasi pembayaran ' . $payment->getCode(),
            'link' => url('admin/payment')
        ];
    }
}
