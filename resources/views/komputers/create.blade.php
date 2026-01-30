@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg bg-slate-200">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Tambah Komputer</h2>
    <form action="{{ route('komputer.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <label for="ruangan" class="block text-sm font-semibold mb-2 text-slate-800">Ruangan</label>
                <select name="ruangan" id="ruangan" class="w-full bg-slate-800 text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white" required>
                    <option value="" disabled selected>Pilih Ruangan</option>
                    @foreach($ruangan as $kategori => $list)
                        <optgroup label="{{ $kategori }}">
                            @foreach($list as $r)
                                <option value="{{ $r }}" {{ old('ruangan') == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                
            </div>

            <div class="mb-4 w-full">
                <label for="unit" class="block text-sm font-semibold mb-2 text-slate-800">Unit</label>
                <select name="unit" id="unit" class="w-full bg-slate-800 text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white" required>
                    <option value="" disabled selected>Pilih Unit</option>
                    <option value="PC Build Up" {{ old('unit') == 'PC Build Up' ? 'selected' : '' }}>PC Build Up</option>
                    <option value="All In One" {{ old('unit') == 'All In One' ? 'selected' : '' }}>All In One</option>
                    <option value="Mini PC" {{ old('unit') == 'Mini PC' ? 'selected' : '' }}>Mini PC</option>
                </select>
                
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                    <label for="brand" class="block text-slate-800 text-sm font-medium mb-2">
                        Brand
                    </label>
                    <x-input 
                        name="brand" 
                        type="text" 
                        placeholder="Brand (opsional)" 
                        icon="mdi:desktop-classic" 
                        :value="old('brand')" 
                    />
                
            </div>
            <div class="mb-4 w-full">
                    <label for="tahun" class="block text-slate-800 text-sm font-medium mb-2">
                        Tahun
                    </label>
                    <x-input 
                        name="tahun" 
                        type="number" 
                        placeholder="Tahun (opsional)" 
                        icon="mdi:calendar" 
                        :value="old('tahun')" 
                        max="9999"
                        oninput="if(this.value.length > 4) this.value = this.value.slice(0,4);"
                    />
                
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                    <label for="os" class="block text-slate-800 text-sm font-medium mb-2">
                        Sistem Operasi
                    </label>
                    <x-input 
                        name="os" 
                        type="text" 
                        placeholder="Operating System (opsional)" 
                        icon="mdi:windows" 
                        :value="old('os')" 
                    />
                
            </div>
            <div class="mb-4 w-full">
                    <label for="processor" class="block text-slate-800 text-sm font-medium mb-2">
                        Processor
                    </label>
                    <x-input 
                        name="processor" 
                        type="text" 
                        placeholder="Processor (opsional)" 
                        icon="mdi:chip" 
                        :value="old('processor')" 
                    />
                
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                    <label for="ram" class="block text-slate-800 text-sm font-medium mb-2">
                        RAM
                    </label>
                    <x-input 
                        name="ram" 
                        type="number" 
                        placeholder="RAM (opsional)" 
                        icon="mdi:memory" 
                        :value="old('ram')" 
                    />
                
            </div>
            <div class="w-full flex items-center gap-2">
                <div class="mb-4 w-76">
                    <label for="storage_type" class="block text-sm font-semibold mb-2 text-slate-800">Tipe Storage</label>
                    <select name="storage_type" id="storage_type" class="w-full bg-slate-800 text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="" disabled selected>Pilih Tipe Storage</option>
                        <option value="SSD" {{ old('storage_type') == 'SSD' ? 'selected' : '' }}>SSD</option>
                        <option value="HDD" {{ old('storage_type') == 'HDD' ? 'selected' : '' }}>HDD</option>
                    </select>
                    
                </div>
                <div class="w-full mb-4">
                        <label for="storage_capacity" class="block text-slate-800 text-sm font-medium mb-2">
                            Kapasitas Storage
                        </label>
                        <x-input 
                            name="storage_capacity" 
                            type="number" 
                            placeholder="Kapasitas Storage satuan GB (opsional)" 
                            icon="mdi:database" 
                            :value="old('storage_capacity')" 
                        />
                    
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                    <label for="kegiatan" class="block text-slate-800 text-sm font-medium mb-2">
                        Kegiatan
                    </label>
                    <x-input 
                        name="kegiatan" 
                        type="text" 
                        placeholder="Kegiatan (opsional)" 
                        icon="mdi:clipboard-text" 
                        :value="old('kegiatan')" 
                    />
                
            </div>
            <div class="mb-4 w-full">
                    <label for="ip_address" class="block text-slate-800 text-sm font-medium mb-2">
                        Ip Address
                    </label>
                    <x-input 
                        name="ip_address" 
                        type="text" 
                        placeholder="IP Address (opsional)" 
                        icon="mdi:ip-network" 
                        :value="old('ip_address')" 
                    />
                
            </div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('komputer.index') }}" class="text-white font-medium mr-3 bg-slate-400 flex items-center py-2 px-4 rounded-lg hover:bg-slate-800 duration-200">Kembali</a>
            <x-button type="submit" icon="ri:computer-line" iconPosition="left">
                Tambah Komputer
            </x-button>
        </div>
    </form>
</div>
@endsection
@section('title', 'Manajemen Komputer')
@section('page-title', 'Manajemen Komputer')
@section('page-subtitle', 'Tambah Komputer RSUD')
