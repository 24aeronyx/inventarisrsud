@extends('layouts.dashboard')

@section('title', 'Laporan Komputer')
@section('page-title', 'Laporan Komputer')
@section('page-subtitle', 'Cetak & Filter Data Komputer RSUD')

@section('content')
<div class="bg-dark-bg-card rounded-lg shadow-md border-2 border-[#262626] p-6">
    <form action="{{ route('komputer.laporan') }}" method="GET" 
          class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        {{-- Filter Ruangan --}}
        <div>
            <label class="block text-dark-text-secondary mb-1">Ruangan</label>
            <select name="ruangan" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
                <option value="">Semua</option>
                @foreach($ruangan['Ruang'] ?? [] as $r)
                    <option value="{{ $r }}" {{ request('ruangan') == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
                @foreach($ruangan['Poli'] ?? [] as $r)
                    <option value="{{ $r }}" {{ request('ruangan') == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
                @foreach($ruangan['Non-Pelayanan'] ?? [] as $r)
                    <option value="{{ $r }}" {{ request('ruangan') == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter Brand --}}
        <div>
            <label class="block text-dark-text-secondary mb-1">Brand</label>
            <select name="brand" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
                <option value="">Semua</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter Kegiatan --}}
        <div>
            <label class="block text-dark-text-secondary mb-1">Kegiatan</label>
            <select name="kegiatan" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
                <option value="">Semua</option>
                @foreach($kegiatans as $kegiatan)
                    <option value="{{ $kegiatan }}" {{ request('kegiatan') == $kegiatan ? 'selected' : '' }}>{{ $kegiatan }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter Tahun --}}
        <div>
            <label class="block text-dark-text-secondary mb-1">Tahun</label>
            <select name="tahun" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
                <option value="">Semua</option>
                @foreach($tahuns as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter Unit --}}
        <div>
            <label class="block text-dark-text-secondary mb-1">Unit</label>
            <select name="unit" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
                <option value="">Semua</option>
                <option value="build up" {{ request('unit') == 'build up' ? 'selected' : '' }}>Build Up</option>
                <option value="all in one" {{ request('unit') == 'all in one' ? 'selected' : '' }}>All In One</option>
            </select>
        </div>

        {{-- Tombol Filter & Cetak --}}
        <div class="flex items-end space-x-2">
            <button type="submit" 
                class="bg-[#262626] text-white px-6 py-2 rounded-lg hover:bg-[#3f3f3f] transition-colors cursor-pointer font-bold">
                Filter
            </button>
            <a href="{{ route('komputer.laporan.print', request()->all()) }}" target="_blank"
                class="bg-white text-[#262626] px-6 py-2 rounded-lg hover:bg-[#f0f0f0] transition-colors font-bold">
                Cetak PDF
            </a>
        </div>
    </form>

    {{-- Tabel Data --}}
    <div class="bg-dark-bg-main rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left text-dark-text-secondary border-b border-[#262626]">
                    <th class="py-3 px-4 font-bold">No</th>
                    <th class="py-3 px-4 font-bold">Ruangan</th>
                    <th class="py-3 px-4 font-bold">Unit</th>
                    <th class="py-3 px-4 font-bold">Brand</th>
                    <th class="py-3 px-4 font-bold">Processor</th>
                    <th class="py-3 px-4 font-bold">RAM</th>
                    <th class="py-3 px-4 font-bold">Storage</th>
                    <th class="py-3 px-4 font-bold">OS</th>
                    <th class="py-3 px-4 font-bold">IP Address</th>
                    <th class="py-3 px-4 font-bold">Kegiatan</th>
                    <th class="py-3 px-4 font-bold">Tahun</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $komputer)
                <tr class="border-t border-[#262626] hover:bg-[#262626] transition-colors">
                    <td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                    <td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $komputer->ruangan }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->unit }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->brand }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->processor }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->ram }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->storage_type }} {{ $komputer->storage_capacity }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->os }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->ip_address }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->kegiatan }}</td>
                    <td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->tahun }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="py-8 px-4 text-center text-dark-text-secondary">
                        Tidak ada data komputer ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
		{{ $data->links() }}
	</div>
</div>
@endsection
