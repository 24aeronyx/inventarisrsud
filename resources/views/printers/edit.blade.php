@extends('layouts.dashboard')

@section('content')
<div class="p-8 rounded-lg bg-slate-200">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Printer</h2>

    <form action="{{ route('printer.update', $printer->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        {{-- ROW 1 --}}
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <label for="ruangan" class="block text-sm font-semibold mb-2 text-slate-800">
                    Ruangan
                </label>
                <select name="ruangan" id="ruangan"
                    class="w-full text-white bg-slate-800 rounded-lg py-3 px-4
                           focus:outline-none focus:ring-2 focus:ring-slate-800"
                    required>
                    <option value="" disabled>Pilih Ruangan</option>
                    @foreach($ruangan as $kategori => $list)
                        <optgroup label="{{ $kategori }}">
                            @foreach($list as $r)
                                <option value="{{ $r }}"
                                    {{ old('ruangan', $printer->ruangan) == $r ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="mb-4 w-full">
                <label class="block text-slate-800 text-sm font-medium mb-2">
                    Brand
                </label>
                <x-input
                    name="brand"
                    type="text"
                    placeholder="Brand"
                    icon="mdi:printer"
                    :value="old('brand', $printer->brand)"
                    required
                />
            </div>
        </div>

        {{-- ROW 2 --}}
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <label class="block text-slate-800 text-sm font-medium mb-2">
                    Jenis Printer
                </label>
                <x-input
                    name="jenis"
                    type="text"
                    placeholder="Jenis Printer"
                    icon="mdi:printer-outline"
                    :value="old('jenis', $printer->jenis)"
                    required
                />
            </div>

            <div class="mb-4 w-full">
                <label class="block text-slate-800 text-sm font-medium mb-2">
                    Tahun
                </label>
                <x-input
                    name="tahun"
                    type="number"
                    placeholder="Tahun (opsional)"
                    icon="mdi:calendar"
                    :value="old('tahun', $printer->tahun)"
                    max="9999"
                    oninput="if(this.value.length > 4) this.value = this.value.slice(0,4);"
                />
            </div>
        </div>

        {{-- ROW 3 --}}
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <label class="block text-slate-800 text-sm font-medium mb-2">
                    Kegiatan
                </label>
                <x-input
                    name="kegiatan"
                    type="text"
                    placeholder="Kegiatan (opsional)"
                    icon="mdi:clipboard-text"
                    :value="old('kegiatan', $printer->kegiatan)"
                />
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex justify-end">
            <a href="{{ route('printer.index') }}"
               class="text-white font-medium mr-3 bg-slate-400
                      flex items-center py-2 px-4 rounded-lg
                      hover:bg-slate-800 hover:text-white transition duration-200">
                Kembali
            </a>

            <x-button type="submit" icon="ri:printer-line" iconPosition="left">
                Simpan Perubahan
            </x-button>
        </div>
    </form>
</div>
@endsection

@section('title', 'Manajemen Printer')
@section('page-title', 'Manajemen Printer')
@section('page-subtitle', 'Edit Printer RSUD')
