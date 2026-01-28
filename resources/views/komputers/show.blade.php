@extends('layouts.dashboard')

@section('title', 'Detail Komputer')
@section('page-title', 'Detail Komputer')
@section('page-subtitle', 'Informasi Detail Perangkat Komputer RSUD')

@section('content')
<div class="p-8 bg-dark-bg-card rounded-xl shadow-xl overflow-hidden border border-[#262626]">
    <div>
        <h2 class="text-3xl font-extrabold text-white mb-6 border-b border-[#262626] pb-4 flex items-center gap-2">
            <iconify-icon icon="ri:computer-line" width="30" height="30" class="text-blue-400"></iconify-icon>
            <span>Spesifikasi Komputer</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
            <div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:office-building" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Ruangan</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->ruangan }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:devices" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Unit</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->unit }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:desktop-classic" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Brand</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->brand }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:calendar" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Tahun</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->tahun }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:windows" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Sistem Operasi</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->os }}</span>
                </div>
            </div>

            <div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:chip" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Processor</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->processor }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:memory" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">RAM</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->ram }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:database" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Tipe Storage</span>
                    <span class="text-white text-lg font-medium ml-2">{{ strtoupper($komputer->storage_type) }}</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:database-outline" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">Kapasitas Storage</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->storage_capacity }} GB</span>
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <iconify-icon icon="mdi:ip-network" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                    <span class="text-dark-text-secondary text-sm">IP Address</span>
                    <span class="text-white text-lg font-medium ml-2">{{ $komputer->ip_address }}</span>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t border-[#333]">
            <div class="flex items-center gap-2 mb-2">
                <iconify-icon icon="mdi:clipboard-text" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
                <span class="text-dark-text-secondary text-sm">Kegiatan / Penggunaan</span>
            </div>
            <p class="text-white text-lg font-medium">{{ $komputer->kegiatan }}</p>
        </div>

    </div>

    <div class="px-8 py-5 flex justify-between items-center rounded-b-xl border-t border-[#333] mt-8">
        <p class="text-dark-text-secondary flex items-center gap-2">
            <iconify-icon icon="mdi:clock-outline" width="16" height="16" class="mr-1"></iconify-icon>
            Diperbarui pada: {{ $komputer->updated_at->format('d M Y, H:i') }}
        </p>
        <a href="{{ route('komputer.index') }}" class="text-white border border-[#333] flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-[#262626] transition-colors mt-4">
            <iconify-icon icon="mdi:arrow-left" width="18" height="18" class="mr-1"></iconify-icon>
            Kembali
        </a>
    </div>
</div>
@endsection