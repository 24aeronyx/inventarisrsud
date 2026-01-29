@extends('layouts.dashboard')

@section('title', 'Manajemen UPS')
@section('page-title', 'Manajemen UPS')
@section('page-subtitle', 'Kelola Data UPS RSUD')

@section('content')
<div class="bg-dark-bg-card rounded-lg shadow-md border-2 border-[#262626] p-6">
	<div class="flex items-center mb-6">
		<div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
			<form action="{{ route('ups.index') }}" method="GET" class="lg:w-96 bg-[#262626] rounded-lg py-3 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200 flex items-center">
				<iconify-icon icon="carbon:search" class="mr-3"></iconify-icon>
				<input type="text" name="query" value="{{ request('query') }}" placeholder="Cari UPS..." class="outline-none bg-transparent text-white placeholder:text-dark-text-secondary">
			</form>
			<a href="{{ route('ups.create') }}" class="flex items-center bg-[#FFFFFF] text-[#0A0A0A] hover:bg-[#A1A1A1] focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200">
				<iconify-icon icon="mdi:thunder-outline" width="20" height="20" class="mr-2"></iconify-icon>
				<span class="font-bold">Tambah UPS</span>
			</a>
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
				@forelse($ups as $item)
				<tr class="border-t border-[#262626] hover:bg-[#262626] transition-colors duration-200">
					<td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $loop->iteration + $ups->firstItem() - 1 }}</td>
					<td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $item->ruangan }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $item->brand }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $item->tahun }}</td>
					<td class="py-3 px-4 text-[#A1A1A1]">{{ $item->kegiatan }}</td>
					
					<td class="py-3 px-4 space-x-6">
						<a href="{{ route('ups.show', $item->id) }}" title="Detail">
							<iconify-icon width="20" height="20" icon="lucide:info" class="text-[#A1A1A1] hover:text-blue-500 transition-colors duration-200"></iconify-icon>
						</a>
						<a href="{{ route('ups.edit', $item->id) }}" title="Edit">
							<iconify-icon width="20" height="20" icon="lucide:edit" class="text-[#A1A1A1] hover:text-yellow-500 transition-colors duration-200"></iconify-icon>
						</a>
						<form action="{{ route('ups.destroy', $item->id) }}" method="POST" class="inline">
							@csrf
							@method('DELETE')
							<button type="submit" class="cursor-pointer" title="Hapus" onclick="return confirm('Yakin ingin menghapus data UPS ini?')">
								<iconify-icon width="20" height="20" icon="lucide:trash" class="text-[#A1A1A1] hover:text-red-500 transition-colors duration-200"></iconify-icon>
							</button>
						</form>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="5" class="py-8 px-4 text-center text-dark-text-secondary">Tidak ada UPS ditemukan.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="mt-6">
		{{ $ups->links() }}
	</div>
</div>
@endsection