<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\OrderRejectedForBuyer;
use App\Notifications\NewRefundForAdmin;
use App\Order;
use App\User;

class RejectPendingOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;
        if ($order->isPending()) {
            $order->status_id = 5;
            $order->save();

            //notify buyer
            $order->user->notify(new OrderRejectedForBuyer($order));

            //notify admin
            $users = User::all();
            foreach ($users as $user) {
                if ($user->isAdmin() || $user->isOperator()) {
                    $user->notify(new NewRefundForAdmin($order));
                }
            }
        }
    }
}
