<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $orders = Order::query()
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->select('orders.*', 'payment_methods.name as payment_method_name')
            ->with([
                'customer.city',
                'courier',
                'orderItems.menu.category',
            ])
            ->orderByDesc('orders.id')
            ->paginate(15);

        return view('dashboard.index', compact('orders'));
    }
}
