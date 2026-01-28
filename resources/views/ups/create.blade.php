@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626]">
    <h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Tambah UPS</h2>
    <form action="{{ route('ups.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <label for="ruangan" class="block text-sm font-semibold mb-2 text-white">Ruangan</label>
                <select name="ruangan" id="ruangan" class="w-full bg-[#262626] text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white" required>
                    <option value="" disabled selected>Pilih Ruangan</option>
                    @foreach($ruangan as $kategori => $list)
                        <optgroup label="{{ $kategori }}">
                            @foreach($list as $r)
                                <option value="{{ $r }}" {{ old('ruangan') == $r ? 'selected' : '' }}>{{ $r }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                
            </div>

            <div class="mb-4 w-full">
                    <label for="brand" class="block text-[#FFFFFF] text-sm font-medium mb-2">
                        Brand
                    </label>
                    <x-input 
                        name="brand" 
                        type="text" 
                        placeholder="Brand" 
                        icon="mdi:thunder-outline" 
                        :value="old('brand')" 
                        required 
                    />
                
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                    <label for="kegiatan" class="block text-[#FFFFFF] text-sm font-medium mb-2">
                        Kegiatan
                    </label>
                    <x-input 
                        name="kegiatan" 
                        type="text" 
                        placeholder="Kegiatan" 
                        icon="mdi:clipboard-text" 
                        :value="old('kegiatan')" 
                        required 
                    />
                
            </div>
            <div class="mb-4 w-full">
                    <label for="tahun" class="block text-[#FFFFFF] text-sm font-medium mb-2">
                        Tahun
                    </label>
                    <x-input 
                        name="tahun" 
                        type="number" 
                        placeholder="Tahun (4 digit)" 
                        icon="mdi:calendar" 
                        :value="old('tahun')" 
                        required 
                        max="9999"
                        oninput="if(this.value.length > 4) this.value = this.value.slice(0,4);"
                    />
                
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('ups.index') }}" class="text-white mr-3 border-2 border-[#262626] flex items-center py-2 px-4 rounded-lg hover:bg-[#262626]">Kembali</a>
            <x-button type="submit" icon="mdi:thunder-outline" iconPosition="left">
                Tambah UPS
            </x-button>
        </div>
    </form>
</div>
@endsection
@section('title', 'Manajemen UPS')
@section('page-title', 'Manajemen UPS')
@section('page-subtitle', 'Tambah UPS RSUD')
