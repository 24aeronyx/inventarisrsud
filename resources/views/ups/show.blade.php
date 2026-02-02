@extends('layouts.dashboard')

@section('title', 'Detail UPS')
@section('page-title', 'Detail UPS')
@section('page-subtitle', 'Informasi Detail UPS RSUD')

@section('content')
    <div class="p-8 flex flex-col gap-4 rounded-lg bg-slate-200">

        {{-- HEADER --}}
        <div class="text-3xl flex items-center gap-2">
            <iconify-icon icon="mdi:thunder-outline" width="30" height="30" class="text-slate-800"></iconify-icon>
            <span class="text-slate-800">Spesifikasi UPS</span>
        </div>

        <hr class="h-0.5 bg-slate-800 border-0">

        {{-- TABLE DETAIL --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <tbody class="text-sm">

                    <tr class="border-b border-slate-300/40">
                        <td class="w-1/4 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:office-building" width="18"></iconify-icon>
                                Ruangan
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $ups->ruangan }}
                        </td>

                        <td class="w-1/4 text-slate-800 font-medium">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="mdi:battery" width="18"></iconify-icon>
                                Brand
                            </div>
                        </td>
                        <td class="py-3 text-slate-800 font-bold">
                            {{ $ups->brand }}
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
                            {{ $ups->tahun }}
                        </td>

                        <td class="py-3 text-slate-800 font-medium"></td>
                        <td class="py-3 text-slate-800 font-bold"></td>
                    </tr>

                </tbody>
            </table>
        </div>

        <hr class="h-0.5 bg-slate-800 border-0 shrink-0">

        {{-- KEGIATAN / PENGGUNAAN --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2 text-slate-800 font-medium">
                <iconify-icon icon="mdi:clipboard-text" width="18"></iconify-icon>
                Kegiatan / Penggunaan
            </div>
            <p class="text-slate-800 font-bold">
                {{ $ups->kegiatan ?? '-' }}
            </p>
        </div>

        <hr class="h-0.5 bg-slate-800 border-0">

        {{-- FOOTER --}}
        <div class="flex items-center justify-between">
            <p class="text-slate-800 font-medium flex items-center gap-2">
                <iconify-icon icon="mdi:clock-outline" width="16" height="16"></iconify-icon>
                Diperbarui pada: {{ $ups->updated_at->format('d M Y, H:i') }}
            </p>

            <a href="{{ route('ups.index') }}"
               class="text-white font-medium bg-slate-800
                      flex items-center gap-2 py-2 px-4 rounded-lg
                      hover:bg-slate-400 transition-colors">
                Kembali
            </a>
        </div>
    </div>
@endsection
