@section('title', $title.' | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
                <p class="mt-1 text-sm text-gray-600">{{ number_format($records->total()) }} data</p>
            </div>
            <a class="rounded border border-gray-400 px-3 py-2 text-sm" href="{{ route($routeName.'.create') }}">
                Tambah data
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
        <a class="text-sm text-blue-700 underline" href="{{ route('admin.index') }}">Kembali ke Kelola Data</a>

        @if (session('status'))
            <p role="status" class="rounded border border-green-300 bg-green-50 p-3 text-sm text-green-800">
                {{ session('status') }}
            </p>
        @endif

        @if (session('error'))
            <p role="alert" class="rounded border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                {{ session('error') }}
            </p>
        @endif

        @if ($errors->any())
            <ul role="alert" class="list-inside list-disc rounded border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="GET" action="{{ route($routeName.'.index') }}" class="flex flex-wrap items-end gap-3 rounded border border-gray-200 bg-white p-4">
            <div class="min-w-56 flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Pencarian</label>
                <input id="search" name="search" type="search" value="{{ request('search') }}" class="mt-1 block w-full rounded border-gray-300 text-sm" placeholder="Masukkan kata kunci">
            </div>

            @isset($categoryOptions)
                <div class="min-w-48">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded border-gray-300 text-sm">
                        <option value="">Semua kategori</option>
                        @foreach ($categoryOptions as $id => $name)
                            <option value="{{ $id }}" @selected((string) request('category_id') === (string) $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            <button type="submit" class="rounded bg-gray-800 px-4 py-2 text-sm text-white">Cari / Filter</button>
            @if (request()->hasAny(['search', 'category_id']))
                <a class="px-2 py-2 text-sm text-blue-700 underline" href="{{ route($routeName.'.index') }}">Reset</a>
            @endif
        </form>

        @if ($records->isEmpty())
            <p class="rounded border border-gray-200 bg-white p-8 text-center text-sm text-gray-600">
                Tidak ada data yang cocok dengan pencarian atau filter.
            </p>
        @else
            <div class="overflow-x-auto rounded border border-gray-200 bg-white">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach ($columns as $column => $label)
                                <th scope="col" class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ $label }}</th>
                            @endforeach
                            <th scope="col" class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($records as $record)
                            <tr>
                                @foreach ($columns as $column => $label)
                                    @php($value = data_get($record, $column))
                                    <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-800">
                                        @if (in_array($column, ['price', 'subtotal'], true))
                                            Rp {{ number_format((float) $value, 0, ',', '.') }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                @endforeach
                                <td class="whitespace-nowrap px-4 py-3 text-sm">
                                    <div class="flex items-center gap-3">
                                        <a class="text-blue-700 underline" href="{{ route($routeName.'.edit', $record) }}">Ubah</a>
                                        <form method="POST" action="{{ route($routeName.'.destroy', $record) }}" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-700 underline" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm text-gray-600">
                    Menampilkan {{ $records->firstItem() }}–{{ $records->lastItem() }} dari {{ number_format($records->total()) }} data
                </p>
                {{ $records->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
