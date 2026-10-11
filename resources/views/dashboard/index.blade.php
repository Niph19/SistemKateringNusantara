@section('title', 'Daftar Pesanan | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-gray-900">
                    Daftar Pesanan
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Pantau pelanggan, menu, dan pengiriman dalam satu tampilan.
                </p>
            </div>

            <p class="text-sm font-medium text-gray-600">
                {{ number_format($orders->total()) }} pesanan
            </p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section aria-labelledby="orders-heading" class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <h2 id="orders-heading" class="sr-only">Tabel pesanan katering</h2>

                @if ($orders->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <p class="text-base font-semibold text-gray-900">Belum ada pesanan</p>
                        <p class="mt-2 text-sm text-gray-600">
                            Data pesanan akan tampil di sini setelah tersedia.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        ID Order
                                    </th>
                                    <th scope="col" class="min-w-52 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Pelanggan
                                    </th>
                                    <th scope="col" class="min-w-80 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Pesanan
                                    </th>
                                    <th scope="col" class="min-w-56 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Pengiriman &amp; Pembayaran
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($orders as $order)
                                    <tr class="align-top transition-colors hover:bg-gray-50">
                                        <td class="whitespace-nowrap px-6 py-5 text-sm font-semibold tabular-nums text-gray-900">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-medium text-gray-900">{{ $order->customer->name }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $order->customer->city->name }}</p>
                                        </td>
                                        <td class="px-6 py-5">
                                            <ul class="space-y-2">
                                                @foreach ($order->orderItems as $item)
                                                    <li class="text-sm leading-5 text-gray-700">
                                                        <span class="font-medium tabular-nums text-gray-900">{{ $item->qty }} &times;</span>
                                                        {{ $item->menu->name }}
                                                        <span class="text-gray-500">({{ $item->menu->category->name }})</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-medium text-gray-900">{{ $order->courier->name }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $order->payment_method_name }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-gray-600">
                            Menampilkan {{ $orders->firstItem() }}–{{ $orders->lastItem() }}
                            dari {{ number_format($orders->total()) }} pesanan
                        </p>
                        <nav aria-label="Navigasi halaman pesanan">
                            {{ $orders->links() }}
                        </nav>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
