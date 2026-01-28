@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626]">
	<h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Tambah Perbaikan</h2>
	<form action="{{ route('perbaikan.store') }}" method="POST" autocomplete="off">
		@csrf
		<div class="flex flex-col lg:flex-row gap-4 items-center">
			<div class="mb-4 w-full">
				<label for="asset_type" class="block text-sm font-semibold mb-2 text-white">Jenis Aset</label>
				<select name="asset_type" id="asset_type" class="w-full bg-[#262626] text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white" required onchange="updateAssetOptions()">
					<option value="" disabled selected>Pilih Jenis Aset</option>
					<option value="App\Models\Komputer" {{ old('asset_type') == 'App\Models\Komputer' ? 'selected' : '' }}>Komputer</option>
					<option value="App\Models\Ups" {{ old('asset_type') == 'App\Models\Ups' ? 'selected' : '' }}>UPS</option>
					<option value="App\Models\Printer" {{ old('asset_type') == 'App\Models\Printer' ? 'selected' : '' }}>Printer</option>
					<option value="App\Models\Cctv" {{ old('asset_type') == 'App\Models\Cctv' ? 'selected' : '' }}>CCTV</option>
					<option value="App\Models\SwitchHub" {{ old('asset_type') == 'App\Models\SwitchHub' ? 'selected' : '' }}>Switch Hub</option>
				</select>
			</div>
			<div class="mb-4 w-full">
				<label for="asset_id" class="block text-sm font-semibold mb-2 text-white">Aset</label>
				<select name="asset_id" id="asset_id" class="w-full bg-[#262626] text-white rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white" required>
					<option value="" disabled selected>Pilih Aset</option>
					@foreach($komputers as $komputer)
						<option value="{{ $komputer->id }}" data-type="App\Models\Komputer" {{ old('asset_id') == $komputer->id && old('asset_type') == 'App\Models\Komputer' ? 'selected' : '' }}>
							{{$komputer->brand}} - {{ $komputer->ruangan }} ({{ $komputer->unit }}, {{$komputer->tahun}})
						</option>
					@endforeach
					@foreach($ups as $upsItem)
						<option value="{{ $upsItem->id }}" data-type="App\Models\Ups" {{ old('asset_id') == $upsItem->id && old('asset_type') == 'App\Models\Ups' ? 'selected' : '' }}>
							{{$upsItem->brand}} - {{ $upsItem->ruangan }} ({{$upsItem->tahun}})
						</option>
					@endforeach
					@foreach($printers as $printer)
						<option value="{{ $printer->id }}" data-type="App\Models\Printer" {{ old('asset_id') == $printer->id && old('asset_type') == 'App\Models\Printer' ? 'selected' : '' }}>
							{{$printer->brand}} - {{ $printer->ruangan ?? $printer->nama }} ({{ $printer->jenis }}, {{$printer->tahun}})
						</option>
					@endforeach
					@foreach($cctvs as $cctv)
						<option value="{{ $cctv->id }}" data-type="App\Models\Cctv" {{ old('asset_id') == $cctv->id && old('asset_type') == 'App\Models\Cctv' ? 'selected' : '' }}>
							{{$cctv->brand}} - {{ $cctv->ruangan ?? $cctv->nama }} ({{$cctv->tahun}})
						</option>
					@endforeach
					@foreach($switches as $switch)
						<option value="{{ $switch->id }}" data-type="App\Models\SwitchHub" {{ old('asset_id') == $switch->id && old('asset_type') == 'App\Models\SwitchHub' ? 'selected' : '' }}>
							{{$switch->brand}} - {{ $switch->ruangan ?? $switch->nama }} ({{ $switch->tahun}})
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="flex flex-col lg:flex-row gap-4 items-center">
			<div class="mb-4 w-full">
				<label for="keterangan" class="block text-[#FFFFFF] text-sm font-medium mb-2">Keterangan</label>
				<x-input name="keterangan" type="text" placeholder="Keterangan perbaikan (opsional)" icon="mdi:clipboard-text" :value="old('keterangan')" />
			</div>
			<div class="mb-4 w-full">
				<label class="block text-[#FFFFFF] text-sm font-medium mb-2">Tanggal</label>
				<input type="text" class="w-full bg-[#262626] text-white rounded-lg py-3 px-4" value="{{ now()->toDateString() }}" readonly>
			</div>
		</div>
		<div class="flex justify-end">
			<a href="{{ route('perbaikan.index') }}" class="text-white mr-3 border-2 border-[#262626] flex items-center py-2 px-4 rounded-lg hover:bg-[#262626]">Kembali</a>
			<x-button type="submit" icon="mdi:tools" iconPosition="left">
				Tambah Perbaikan
			</x-button>
		</div>
	</form>
</div>
@endsection
@section('title', 'Manajemen Perbaikan')
@section('page-title', 'Manajemen Perbaikan')
@section('page-subtitle', 'Tambah Perbaikan Aset RSUD')

@push('scripts')
<script>
function updateAssetOptions() {
	var type = document.getElementById('asset_type').value;
	var assetSelect = document.getElementById('asset_id');
	for (var i = 0; i < assetSelect.options.length; i++) {
		var opt = assetSelect.options[i];
		if (!opt.value) continue;
		if (opt.getAttribute('data-type') === type) {
			opt.style.display = '';
		} else {
			opt.style.display = 'none';
		}
	}
	assetSelect.value = '';
}
document.addEventListener('DOMContentLoaded', function() {
	updateAssetOptions();
});
</script>
@endpush
