<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ManagementController extends Controller
{
    public function index(): View
    {
        $resources = [
            ['name' => 'Kota', 'route' => 'admin.cities.index'],
            ['name' => 'Kategori', 'route' => 'admin.categories.index'],
            ['name' => 'Metode pembayaran', 'route' => 'admin.payment-methods.index'],
            ['name' => 'Kurir', 'route' => 'admin.couriers.index'],
            ['name' => 'Pelanggan', 'route' => 'admin.customers.index'],
            ['name' => 'Menu', 'route' => 'admin.menus.index'],
            ['name' => 'Pesanan', 'route' => 'admin.orders.index'],
            ['name' => 'Item pesanan', 'route' => 'admin.order-items.index'],
        ];

        return view('admin.index', compact('resources'));
    }
}
