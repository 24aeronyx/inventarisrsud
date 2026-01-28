@extends('layouts.dashboard')

@section('title', 'Manajemen Komputer')
@section('page-title', 'Manajemen Komputer')
@section('page-subtitle', 'Kelola Data Komputer RSUD')

@section('content')
<div class="bg-dark-bg-card rounded-lg shadow-md border-2 border-[#262626] p-6">
	<div class="flex items-center mb-6">
		<div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
			<form action="{{ route('komputer.index') }}" method="GET" class="lg:w-96 bg-[#262626] rounded-lg py-3 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200 flex items-center">
				<iconify-icon icon="carbon:search" class="mr-3"></iconify-icon>
				<input type="text" name="query" value="{{ request('query') }}" placeholder="Cari komputer..." class="outline-none bg-transparent text-white placeholder:text-dark-text-secondary">
			</form>
			<form action="{{ route('komputer.index') }}" method="GET" class="flex gap-4 items-center">
				<div class="relative w-full flex justify-between items-center flex-col md:flex-row gap-2 lg:w-auto">
				<div class="flex items-center bg-[#262626] rounded-lg py-[5px] px-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200">
					<label for="unit" class="text-white mr-2">Unit</label>
					<select name="unit" id="unit" class="bg-[#262626] text-white rounded-lg py-2 px-3">
						<option value="">Semua</option>
						<option value="PC Build Up" {{ request('unit') == 'PC Build Up' ? 'selected' : '' }}>PC Build Up</option>
						<option value="All In One" {{ request('unit') == 'All In One' ? 'selected' : '' }}>All In One</option>
						<option value="Mini PC" {{ request('unit') == 'Mini PC' ? 'selected' : '' }}>Mini PC</option>
					</select>
				</div>
					<button type="submit" class="bg-[#FFFFFF] text-[#0A0A0A] hover:bg-[#A1A1A1] focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200 font-bold">Filter</button>
				</div>
				<a href="{{ route('komputer.create') }}" class="flex items-center bg-[#FFFFFF] text-[#0A0A0A] hover:bg-[#A1A1A1] focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200">
					<iconify-icon icon="ri:computer-line" width="20" height="20" class="mr-2"></iconify-icon>
					<span class="font-bold">Tambah Komputer</span>
				</a>
			</form>
		</div>
	</div>

	<div class="bg-dark-bg-main rounded-lg overflow-x-auto">
		<table class="min-w-full">
			<thead>
				<tr class="text-left text-dark-text-secondary text-sm">
					<th class="py-3 px-4 font-bold">No</th>
					@foreach($columns as $col => $label)
					<th class="py-3 px-4 font-bold">
						<a href="{{ sortUrl($col, $sort ?? 'id', $direction ?? 'asc') }}" class="flex items-center gap-1 group">
							{{ $label }}
							<span class="flex flex-col ml-1">
								<iconify-icon 
								icon="mdi:arrow-up" 
								width="14" height="14"
								@if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'asc')
								class="text-blue-500"
								@else
								class="text-[#A1A1A1] opacity-40 group-hover:opacity-80"
								@endif
								></iconify-icon>
								<iconify-icon 
								icon="mdi:arrow-down" 
								width="14" height="14"
								@if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'desc')
								class="text-blue-500"
								@else
								class="text-[#A1A1A1] opacity-40 group-hover:opacity-80"
								@endif
								></iconify-icon>
							</span>
						</a>
					</th>
					@endforeach
					<th class="py-3 px-4 font-bold">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse($komputers as $komputer)
				<tr class="border-t border-[#262626] hover:bg-[#262626] transition-colors duration-200">
					<td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $loop->iteration + $komputers->firstItem() - 1 }}</td>
					<td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $komputer->ruangan }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ ucfirst(str_replace('_', ' ', $komputer->unit)) }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->brand }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->tahun }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $komputer->os }}</td>
					<td class="py-3 px-4 space-x-6">
						<a href="{{ route('komputer.show', $komputer->id) }}" title="Detail">
							<iconify-icon width="20" height="20" icon="lucide:info" class="text-[#A1A1A1] hover:text-blue-500 transition-colors duration-200"></iconify-icon>
						</a>
						<a href="{{ route('komputer.edit', $komputer->id) }}" title="Edit">
							<iconify-icon width="20" height="20" icon="lucide:edit" class="text-[#A1A1A1] hover:text-yellow-500 transition-colors duration-200"></iconify-icon>
						</a>
						<form action="{{ route('komputer.destroy', $komputer->id) }}" method="POST" class="inline">
							@csrf
							@method('DELETE')
							<button type="submit" class="cursor-pointer" title="Hapus" onclick="return confirm('Yakin ingin menghapus data komputer ini?')">
								<iconify-icon width="20" height="20" icon="lucide:trash" class="text-[#A1A1A1] hover:text-red-500 transition-colors duration-200"></iconify-icon>
							</button>
						</form>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="6" class="py-8 px-4 text-center text-dark-text-secondary">Tidak ada komputer ditemukan.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="mt-6">
		{{ $komputers->links() }}
	</div>
</div>
@endsection