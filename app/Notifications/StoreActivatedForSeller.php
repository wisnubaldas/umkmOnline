<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreActivatedForSeller extends Notification
{
    use Queueable;
    public $store;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($store)
    {
        $this->store = $store;
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
        $store = $this->store;

        return [
            'title' => 'Toko Diaktifkan',
            'icon' => 'fa fa-building bg-green',
            'message' => 'Toko Baru anda '.$store->name.' telah diaktifkan. Selamat berjualan! :)',
            'link' => url('store/yours')
        ];
    }
}
