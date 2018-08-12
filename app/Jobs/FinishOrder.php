<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\FinishedOrderForSeller;
use App\Notifications\NewAdminPaymentForAdmin;
use App\Order;

class FinishOrder implements ShouldQueue
{
    protected $order;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        if ($order->isSent()) {
            $order->status_id = 4;
            $order->save();

            //notify seller
            $order->store->user->notify(new FinishedOrderForSeller($order));

            //notify admin
            $users = \App\User::all();
            foreach ($users as $user) {
                if ($user->isAdmin() || $user->isOperator()) {
                    $user->notify(new NewAdminPaymentForAdmin($order));
                }
            }
        }
    }
}
