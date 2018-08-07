<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Payment;
use App\Order;
use App\Store;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //pembayaran masuk yang pending / belum bayar
        $nPendingPayment = Payment::where('is_paid', 0)->count();

        //pembayaran keluar
        $nPendingAdminPayment = 0;
        $finishedOrders = Order::where('status_id', 4)->get();
        foreach ($finishedOrders as $order) {
            if (!$order->isPaidAdminPayment()) {
                $nPendingAdminPayment += 1;
            }
        }

        //pengembalian dana yang pending
        $nPendingRefund = 0;
        $rejectedOrders = Order::where('status_id', 5)->get();
        foreach ($rejectedOrders as $order) {
            if (!$order->isPaidRefund()) {
                $nPendingRefund += 1;
            }
        }

        //toko tidak aktif
        $nNotActiveStore = Store::where('is_active', 0)->count();

        View::share('nPendingPayment', $nPendingPayment);
        view::share('nPendingAdminPayment', $nPendingAdminPayment);
        View::share('nPendingRefund', $nPendingRefund);
        View::share('nNotActiveStore', $nNotActiveStore);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
