@section('title', ($record ? 'Ubah ' : 'Tambah ').$title.' | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $record ? 'Ubah' : 'Tambah' }} {{ $title }}</h1>
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
        <a class="text-sm text-blue-700 underline" href="{{ route($routeName.'.index') }}">Kembali ke daftar {{ strtolower($title) }}</a>

        <form method="POST" action="{{ $record ? route($routeName.'.update', $record) : route($routeName.'.store') }}" class="space-y-5 rounded border border-gray-200 bg-white p-5">
            @csrf
            @if ($record)
                @method('PUT')
            @endif

            @foreach ($fields as $name => $field)
                <div>
                    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>

                    @if ($field['type'] === 'select')
                        <select id="{{ $name }}" name="{{ $name }}" required class="mt-1 block w-full rounded border-gray-300 text-sm">
                            <option value="">Pilih {{ strtolower($field['label']) }}</option>
                            @foreach ($field['options'] as $value => $label)
                                <option value="{{ $value }}" @selected((string) old($name, data_get($record, $name)) === (string) $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    @else
                        <input
                            id="{{ $name }}"
                            name="{{ $name }}"
                            type="{{ $field['type'] }}"
                            value="{{ old($name, data_get($record, $name)) }}"
                            @if (isset($field['min'])) min="{{ $field['min'] }}" @endif
                            @if (isset($field['step'])) step="{{ $field['step'] }}" @endif
                            required
                            class="mt-1 block w-full rounded border-gray-300 text-sm"
                        >
                    @endif

                    <x-input-error :messages="$errors->get($name)" class="mt-2" />
                </div>
            @endforeach

            @isset($formNote)
                <p class="text-sm text-gray-600">{{ $formNote }}</p>
            @endisset

            <button type="submit" class="rounded bg-gray-800 px-4 py-2 text-sm text-white">Simpan</button>
        </form>
    </div>
</x-app-layout>
