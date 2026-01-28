@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626] max-w-xl mx-auto">
    <h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Detail Switch/Hub</h2>
    <table class="min-w-full bg-[#262626] text-white rounded-lg">
        <tr><th class="py-3 px-4">Ruangan</th><td class="py-3 px-4">{{ $switchhub->ruangan }}</td></tr>
        <tr><th class="py-3 px-4">Brand</th><td class="py-3 px-4">{{ $switchhub->brand }}</td></tr>
        <tr><th class="py-3 px-4">Kegiatan</th><td class="py-3 px-4">{{ $switchhub->kegiatan }}</td></tr>
        <tr><th class="py-3 px-4">Tahun</th><td class="py-3 px-4">{{ $switchhub->tahun }}</td></tr>
    </table>
    <div class="mt-6 flex justify-end">
        <a href="{{ route('switchhub.index') }}" class="text-white border-2 border-[#262626] flex items-center py-2 px-4 rounded-lg hover:bg-[#262626]">Kembali</a>
    </div>
</div>
@endsection
@section('title', 'Detail Switch/Hub')
@section('page-title', 'Detail Switch/Hub')
@section('page-subtitle', 'Detail Data Switch/Hub RSUD')
