@section('title', 'Kelola Data | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Kelola Data</h1>
        <p class="mt-1 text-sm text-gray-600">Pilih data yang ingin ditampilkan atau dikelola.</p>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
        <a class="text-sm text-blue-700 underline" href="{{ route('dashboard') }}">Kembali ke dashboard</a>

        <ul class="divide-y divide-gray-200 rounded-md border border-gray-200 bg-white">
            @foreach ($resources as $resource)
                <li class="flex items-center justify-between gap-4 px-4 py-3">
                    <span>{{ $resource['name'] }}</span>
                    <a class="text-sm text-blue-700 underline" href="{{ route($resource['route']) }}">Buka daftar</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
