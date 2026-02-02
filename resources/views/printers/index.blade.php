
@extends('layouts.dashboard')

@section('title', 'Manajemen Printer')
@section('page-title', 'Manajemen Printer')
@section('page-subtitle', 'Kelola Data Printer RSUD')

@section('content')
<div class="bg-slate-200 rounded-lg p-6">
	<div class="flex items-center mb-6">
		<div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
			<form action="{{ route('printer.index') }}" method="GET" class="lg:w-96 bg-slate-100 rounded-lg py-3 pl-3 pr-4 flex items-center">
				<iconify-icon icon="carbon:search" class="mr-3 text-slate-800"></iconify-icon>
				<input type="text" name="query" value="{{ request('query') }}" placeholder="Cari printer" class="outline-none bg-transparent text-slate-800 placeholder:text-slate-500">
			</form>
			<a href="{{ route('printer.create') }}" class="flex items-center text-white bg-slate-800 font-medium cursor-pointer rounded-lg py-3 px-4">
				<iconify-icon icon="ri:printer-line" width="20" height="20" class="mr-2"></iconify-icon>
				<span>Tambah Printer</span>
			</a>
		</div>
	</div>

	<div class="bg-dark-bg-main rounded-lg overflow-x-auto border-2 border-slate-800">
		<table class="min-w-full">
			<thead class="bg-slate-800">
				<tr class="text-left text-white text-sm font-medium">
					<th class="py-3 px-4 font-medium">No</th>
					@foreach($columns as $col => $label)
					<th class="py-3 px-4 font-medium">
						<a href="{{ sortUrl($col, $sort ?? 'id', $direction ?? 'asc') }}" class="flex items-center gap-1 group">
							{{ $label }}
							<span class="flex flex-col ml-1">
								<iconify-icon 
								icon="mdi:arrow-up" 
								width="14" height="14"
								@if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'asc')
								class="text-white"
								@else
								class="text-[#A1A1A1] opacity-40 group-hover:opacity-80"
								@endif
								></iconify-icon>
								<iconify-icon 
								icon="mdi:arrow-down" 
								width="14" height="14"
								@if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'desc')
								class="text-white"
								@else
								class="text-[#A1A1A1] opacity-40 group-hover:opacity-80"
								@endif
								></iconify-icon>
							</span>
						</a>
					</th>
					@endforeach
					<th class="py-3 px-4 font-medium">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse($printers as $printer)
				<tr class="text-slate-800 font-medium">
					<td class="py-3 px-4">{{ $loop->iteration + $printers->firstItem() - 1 }}</td>
					<td class="py-3 px-4">{{ $printer->ruangan }}</td>
					<td class="py-3 px-4">{{ $printer->brand }}</td>
					<td class="py-3 px-4">{{ $printer->jenis }}</td>
					<td class="py-3 px-4">{{ $printer->tahun }}</td>
					<td class="py-3 px-4 flex justify-start items-center gap-4">
						<a href="{{ route('printer.show', $printer->id) }}" title="Detail">
							<iconify-icon width="20" height="20" icon="lucide:info" class="text-slate-800 hover:text-blue-500 transition-colors duration-200"></iconify-icon>
						</a>
						<a href="{{ route('printer.edit', $printer->id) }}" title="Edit">
							<iconify-icon width="20" height="20" icon="lucide:edit" class="text-slate-800 hover:text-yellow-500 transition-colors duration-200"></iconify-icon>
						</a>
						<form action="{{ route('printer.destroy', $printer->id) }}" method="POST" class="inline">
							@csrf
							@method('DELETE')
							<button type="submit" class="cursor-pointer" title="Hapus" onclick="return confirm('Yakin ingin menghapus data printer ini?')">
								<iconify-icon width="20" height="20" icon="lucide:trash" class="text-slate-800 hover:text-red-500 transition-colors duration-200"></iconify-icon>
							</button>
						</form>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="5" class="py-8 px-4 text-center text-dark-text-secondary">Tidak ada printer ditemukan.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="mt-6">
		{{ $printers->links() }}
	</div>
</div>
@endsection