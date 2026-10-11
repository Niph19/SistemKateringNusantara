@section('title', ($record ? 'Ubah ' : 'Tambah ').$title.' | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold tracking-widest uppercase text-emas-500/70 mb-1">
                ✦ {{ $record ? 'Edit Data' : 'Tambah Data' }} ✦
            </p>
            <h1 class="text-2xl font-bold tracking-tight text-gradient-emas font-serif">
                {{ $record ? 'Ubah' : 'Tambah' }} {{ $title }}
            </h1>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('admin.index') }}"
                   class="text-legam-500 hover:text-emas-600 transition-colors flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Kelola Data
                </a>
                <svg class="w-3 h-3 text-legam-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route($routeName.'.index') }}"
                   class="text-legam-500 hover:text-emas-600 transition-colors">
                    {{ $title }}
                </a>
                <svg class="w-3 h-3 text-legam-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-emas-600 font-medium">{{ $record ? 'Ubah' : 'Tambah' }}</span>
            </nav>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div role="alert"
                     class="rounded-lg px-4 py-3 text-sm text-tera-800"
                     style="background: #fff5f2; border: 1px solid #fca38a;">
                    <p class="font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-tera-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Terdapat kesalahan pada formulir:
                    </p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="card-nusantara overflow-visible">

                {{-- Header form --}}
                <div class="batik-header-bg px-5 py-4 flex items-center gap-2 rounded-t-xl"
                     style="border-bottom: 1px solid rgba(240,180,41,0.20);">
                    <span class="block w-1 h-5 rounded-full" style="background: linear-gradient(to bottom, #f0b429, #a87000);"></span>
                    <h2 class="text-sm font-semibold text-emas-400 uppercase tracking-wider">
                        Formulir {{ $title }}
                    </h2>
                </div>

                {{-- Form Body --}}
                <form method="POST"
                      action="{{ $record ? route($routeName.'.update', $record) : route($routeName.'.store') }}"
                      class="p-6 space-y-5">
                    @csrf
                    @if ($record)
                        @method('PUT')
                    @endif

                    @foreach ($fields as $name => $field)
                        <div>
                            <label for="{{ $name }}"
                                   class="block text-sm font-medium text-legam-700 mb-1.5">
                                {{ $field['label'] }}
                                <span class="text-tera-500 ml-0.5" aria-label="wajib diisi">*</span>
                            </label>

                            @if ($field['type'] === 'select')
                                <select id="{{ $name }}"
                                        name="{{ $name }}"
                                        required
                                        class="input-legam @error($name) border-tera-400 ring-1 ring-tera-400/30 @enderror">
                                    <option value="">— Pilih {{ strtolower($field['label']) }} —</option>
                                    @foreach ($field['options'] as $value => $label)
                                        <option value="{{ $value }}"
                                                @selected((string) old($name, data_get($record, $name)) === (string) $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                            @elseif ($field['type'] === 'textarea')
                                <textarea id="{{ $name }}"
                                          name="{{ $name }}"
                                          rows="4"
                                          required
                                          class="input-legam @error($name) border-tera-400 ring-1 ring-tera-400/30 @enderror"
                                          placeholder="{{ $field['placeholder'] ?? '' }}">{{ old($name, data_get($record, $name)) }}</textarea>

                            @else
                                <input id="{{ $name }}"
                                       name="{{ $name }}"
                                       type="{{ $field['type'] }}"
                                       value="{{ old($name, data_get($record, $name)) }}"
                                       @isset($field['min']) min="{{ $field['min'] }}" @endisset
                                       @isset($field['max']) max="{{ $field['max'] }}" @endisset
                                       @isset($field['step']) step="{{ $field['step'] }}" @endisset
                                       @isset($field['placeholder']) placeholder="{{ $field['placeholder'] }}" @endisset
                                       required
                                       class="input-legam @error($name) border-tera-400 ring-1 ring-tera-400/30 @enderror">
                            @endif

                            <x-input-error :messages="$errors->get($name)" class="mt-1.5" />
                        </div>
                    @endforeach

                    {{-- Catatan form jika ada --}}
                    @isset($formNote)
                        <p class="text-sm text-legam-500 flex items-start gap-2"
                           style="background: #f7f1e8; border-radius: 0.5rem; padding: 0.75rem; border: 1px solid #e8d9c4;">
                            <svg class="w-4 h-4 text-emas-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $formNote }}
                        </p>
                    @endisset

                    {{-- Divider dekoratif --}}
                    <div class="batik-divider">
                        <span>⬥</span>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold
                                       text-legam-950 shadow-emas transition-all duration-150
                                       focus:outline-none focus:ring-2 focus:ring-emas-400/40"
                                style="background: linear-gradient(135deg, #f0b429, #a87000);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Data
                        </button>

                        <a href="{{ route($routeName.'.index') }}"
                           class="inline-flex items-center gap-1.5 text-sm text-legam-500
                                  hover:text-legam-700 px-4 py-2.5 rounded-lg
                                  hover:bg-legam-100 transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
