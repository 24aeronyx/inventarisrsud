@extends('layouts.dashboard')

@section('title', 'Laporan Perbaikan')
@section('page-title', 'Laporan Perbaikan')
@section('page-subtitle', 'Cetak & Filter Data Perbaikan Aset RSUD')

@section('content')
<div class="bg-dark-bg-card rounded-lg shadow-md border-2 border-[#262626] p-6">
	<form action="{{ route('perbaikan.laporan') }}" method="GET" 
		  class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

		<div>
			<label class="block text-dark-text-secondary mb-1">Jenis Aset</label>
			<select name="asset_type" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
				<option value="">Semua</option>
				@foreach($asset_types as $type)
                <option value="{{ $type }}" {{ request('asset_type') == $type ? 'selected' : '' }}>{{ class_basename($type) }}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label class="block text-dark-text-secondary mb-1">Tahun</label>
			<select name="tahun" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3">
				<option value="">Semua</option>
				@php $tahunList = collect($tgls)->map(function($tgl){ return \Carbon\Carbon::parse($tgl)->year; })->unique(); @endphp
				@foreach($tahunList as $tahun)
					<option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
				@endforeach
			</select>
		</div>

		
		<div>
			<label class="block text-dark-text-secondary mb-1">Keterangan</label>
			<input type="text" name="keterangan" value="{{ request('keterangan') }}" class="w-full bg-[#262626] text-white rounded-lg py-2 px-3" placeholder="Cari keterangan...">
		</div>

		
		<div class="flex items-end space-x-2">
			<button type="submit" 
				class="bg-[#262626] text-white px-6 py-2 rounded-lg hover:bg-[#3f3f3f] transition-colors cursor-pointer font-bold">
				Filter
			</button>
			<a href="{{ route('perbaikan.laporan.print', request()->all()) }}" target="_blank"
				class="bg-white text-[#262626] px-6 py-2 rounded-lg hover:bg-[#f0f0f0] transition-colors font-bold">
				Cetak PDF
			</a>
		</div>
	</form>

	
	<div class="bg-dark-bg-main rounded-lg overflow-x-auto">
		<table class="min-w-full text-sm">
			<thead>
				<tr class="text-left text-dark-text-secondary border-b border-[#262626]">
					<th class="py-3 px-4 font-bold">No</th>
					<th class="py-3 px-4 font-bold">Tanggal</th>
					<th class="py-3 px-4 font-bold">Jenis Aset</th>
					<th class="py-3 px-4 font-bold">Ruangan</th>
					<th class="py-3 px-4 font-bold">Tahun</th>
					<th class="py-3 px-4 font-bold">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				@forelse($data as $perbaikan)
				<tr class="border-t border-[#262626] hover:bg-[#262626] transition-colors">
					<td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $loop->iteration + $data->firstItem() - 1 }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $perbaikan->tgl }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ class_basename($perbaikan->asset_type) }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ optional($perbaikan->asset)->ruangan ?? optional($perbaikan->asset)->nama ?? '-' }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ optional($perbaikan->asset)->tahun ?? '-' }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $perbaikan->keterangan }}</td>
				</tr>
				@empty
				<tr>
					<td colspan="6" class="py-8 px-4 text-center text-dark-text-secondary">
						Tidak ada data perbaikan ditemukan.
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
