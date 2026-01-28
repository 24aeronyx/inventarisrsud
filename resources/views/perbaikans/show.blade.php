@extends('layouts.dashboard')

@section('title', 'Detail Perbaikan')
@section('page-title', 'Detail Perbaikan')
@section('page-subtitle', 'Informasi Detail Perbaikan Aset RSUD')

@section('content')
<div class="p-8 bg-dark-bg-card rounded-xl shadow-xl overflow-hidden border border-[#262626]">
	<div>
		<h2 class="text-3xl font-extrabold text-white mb-6 border-b border-[#262626] pb-4 flex items-center gap-2">
			<iconify-icon icon="mdi:tools" width="30" height="30" class="text-blue-400"></iconify-icon>
			<span>Detail Perbaikan</span>
		</h2>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
			<div>
				<div class="mb-4 flex items-center gap-2">
					<iconify-icon icon="mdi:calendar" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
					<span class="text-dark-text-secondary text-sm">Tanggal Perbaikan</span>
					<span class="text-white text-lg font-medium ml-2">{{ $perbaikan->tgl }}</span>
				</div>
				<div class="mb-4 flex items-center gap-2">
					<iconify-icon icon="mdi:shape" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
					<span class="text-dark-text-secondary text-sm">Jenis Aset</span>
					<span class="text-white text-lg font-medium ml-2">{{ class_basename($perbaikan->asset_type) }}</span>
				</div>
				<div class="mb-4 flex items-center gap-2">
					<iconify-icon icon="mdi:office-building" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
					<span class="text-dark-text-secondary text-sm">Ruangan/Nama Aset</span>
					<span class="text-white text-lg font-medium ml-2">{{ optional($perbaikan->asset)->ruangan ?? optional($perbaikan->asset)->nama ?? '-' }}</span>
				</div>
				<div class="mb-4 flex items-center gap-2">
					<iconify-icon icon="mdi:calendar" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
					<span class="text-dark-text-secondary text-sm">Tahun</span>
					<span class="text-white text-lg font-medium ml-2">{{ optional($perbaikan->asset)->tahun ?? '-' }}</span>
				</div>
			</div>

			<div>
				<div class="mb-4 flex items-center gap-2">
					<iconify-icon icon="mdi:clipboard-text" class="text-[#A1A1A1]" width="18" height="18"></iconify-icon>
					<span class="text-dark-text-secondary text-sm">Keterangan Perbaikan</span>
					<span class="text-white text-lg font-medium ml-2">{{ $perbaikan->keterangan ?? '-' }}</span>
				</div>
			</div>
		</div>

	</div>

	<div class="px-8 py-5 flex justify-between items-center rounded-b-xl border-t border-[#333] mt-8">
		<p class="text-dark-text-secondary flex items-center gap-2">
			<iconify-icon icon="mdi:clock-outline" width="16" height="16" class="mr-1"></iconify-icon>
			Diperbarui pada: {{ $perbaikan->updated_at->format('d M Y, H:i') }}
		</p>
		<a href="{{ route('perbaikan.index') }}" class="text-white border border-[#333] flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-[#262626] transition-colors mt-4">
			<iconify-icon icon="mdi:arrow-left" width="18" height="18" class="mr-1"></iconify-icon>
			Kembali
		</a>
	</div>
</div>
@endsection
