@extends('layouts.dashboard')

@section('title', 'Detail Komputer')
@section('page-title', 'Detail Komputer')
@section('page-subtitle', 'Informasi Detail Perangkat Komputer RSUD')

@section('content')
    <div class="p-8 flex flex-col gap-4 rounded-lg bg-slate-200">
        <div class="text-3xl text-white flex items-center gap-2">
            <iconify-icon icon="ri:computer-line" width="30" height="30" class="text-slate-800"></iconify-icon>
            <span class="text-slate-800">Spesifikasi Komputer</span>
        </div>
        <hr class="h-0.5 bg-slate-800 border-0">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <tbody class="text-sm">

                    {{-- KOLOM KIRI --}}
                    <tr class="border-b border-slate-300/40">
                        <td class="w-1/4 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:office-building" width="18"></iconify-icon>
                                Ruangan
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->ruangan }}
                        </td>

                        <td class="py-3 w-1/4 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:chip" width="18"></iconify-icon>
                                Processor
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->processor }}
                        </td>
                    </tr>

                    <tr class="border-b border-slate-300/40">
                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:devices" width="18"></iconify-icon>
                                Unit
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->unit }}
                        </td>

                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:memory" width="18"></iconify-icon>
                                RAM
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->ram }}
                        </td>
                    </tr>

                    <tr class="border-b border-slate-300/40">
                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:desktop-classic" width="18"></iconify-icon>
                                Brand
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->brand }}
                        </td>

                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:database" width="18"></iconify-icon>
                                Tipe Storage
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ strtoupper($komputer->storage_type) }}
                        </td>
                    </tr>

                    <tr class="border-b border-slate-300/40">
                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:calendar" width="18"></iconify-icon>
                                Tahun
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->tahun }}
                        </td>

                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:database-outline" width="18"></iconify-icon>
                                Kapasitas Storage
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->storage_capacity }} GB
                        </td>
                    </tr>

                    <tr class="border-b border-slate-300/40">
                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:windows" width="18"></iconify-icon>
                                Sistem Operasi
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->os }}
                        </td>

                        <td class="py-3 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:ip-network" width="18"></iconify-icon>
                                IP Address
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $komputer->ip_address ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="h-0.5 bg-slate-800 border-0 shrink-0">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2 text-slate-800 font-medium">
                <iconify-icon icon="mdi:clipboard-text" width="18"></iconify-icon>
                Kegiatan / Penggunaan
            </div>
            <p class="text-slate-800 font-bold">
                {{ $komputer->kegiatan ?? '-' }}
            </p>
        </div>
        <hr class="h-0.5 bg-slate-800 border-0">
        <div class=" flex items-center justify-between">
            <p class="text-slate-800 font-medium flex items-center gap-2">
                <iconify-icon icon="mdi:clock-outline" width="16" height="16" class="mr-1"></iconify-icon>
                Diperbarui pada: {{ $komputer->updated_at->format('d M Y, H:i') }}
            </p>
            <a href="{{ route('komputer.index') }}"
                class="text-white font-medium bg-slate-800 flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-slate-400 transition-colors">
                Kembali
            </a>
        </div>
    </div>
@endsection