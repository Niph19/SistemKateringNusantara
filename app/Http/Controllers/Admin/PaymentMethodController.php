<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->validate(['search' => ['nullable', 'string', 'max:100']])['search'] ?? '';
        $records = PaymentMethod::query()
            ->withCount('orders')
            ->where('name', 'like', '%'.trim($search).'%')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.resources.index', [
            'title' => 'Metode pembayaran',
            'routeName' => 'admin.payment-methods',
            'records' => $records,
            'columns' => ['name' => 'Nama metode', 'orders_count' => 'Jumlah pesanan'],
        ]);
    }

    public function create(): View
    {
        return $this->form();
    }

    public function store(Request $request): RedirectResponse
    {
        PaymentMethod::create($request->validate(['name' => ['required', 'string', 'max:255']]));

        return to_route('admin.payment-methods.index')->with('status', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit(PaymentMethod $paymentMethod): View
    {
        return $this->form($paymentMethod);
    }

    public function update(Request $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $paymentMethod->update($request->validate(['name' => ['required', 'string', 'max:255']]));

        return to_route('admin.payment-methods.index')->with('status', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod): RedirectResponse
    {
        if ($paymentMethod->orders()->exists()) {
            return back()->with('error', 'Metode pembayaran masih digunakan oleh pesanan dan tidak dapat dihapus.');
        }

        $paymentMethod->delete();

        return to_route('admin.payment-methods.index')->with('status', 'Metode pembayaran berhasil dihapus.');
    }

    private function form(?PaymentMethod $paymentMethod = null): View
    {
        return view('admin.resources.form', [
            'title' => 'Metode pembayaran',
            'routeName' => 'admin.payment-methods',
            'record' => $paymentMethod,
            'fields' => ['name' => ['label' => 'Nama metode pembayaran', 'type' => 'text']],
        ]);
    }
}
