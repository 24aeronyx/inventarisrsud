@extends('layouts.dashboard')

@section('title', 'Manajemen Komputer')
@section('page-title', 'Manajemen Komputer')
@section('page-subtitle', 'Kelola Data Komputer RSUD')

@section('content')
	<div class="bg-dark-bg-card rounded-lg bg-slate-200 p-6">
		<div class="flex items-center mb-6">
			<div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
				<form action="{{ route('komputer.index') }}" method="GET"
					class="lg:w-96 bg-slate-100 rounded-lg py-3 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200 flex items-center">
					<iconify-icon icon="carbon:search" class="mr-3 text-slate-800"></iconify-icon>
					<input type="text" name="query" value="{{ request('query') }}" placeholder="Cari komputer"
						class="outline-none bg-transparent text-slate-800 placeholder:text-gray-500">
				</form>
				<form action="{{ route('komputer.index') }}" method="GET" class="flex gap-4 items-center">
					<div class="w-full flex justify-between items-center flex-col md:flex-row gap-2 lg:w-auto">
						<div
							class="flex items-center bg-slate-100 rounded-lg h-12  focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200">
							<label for="unit" class="text-slate-800 text-center px-2 font-medium">Unit</label>
							<select name="unit" id="unit"
								class="bg-slate-800 h-12 text-white text-center rounded-r-lg font-medium">
								<option value="">Semua</option>
								<option value="PC Build Up" {{ request('unit') == 'PC Build Up' ? 'selected' : '' }}>PC Build
									Up</option>
								<option value="All In One" {{ request('unit') == 'All In One' ? 'selected' : '' }}>All In One
								</option>
								<option value="Mini PC" {{ request('unit') == 'Mini PC' ? 'selected' : '' }}>Mini PC</option>
							</select>
						</div>
						<button type="submit"
							class="bg-slate-800 text-white font-medium focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200">Filter</button>
					</div>
					<a href="{{ route('komputer.create') }}"
						class="flex items-center bg-slate-800 text-white focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200 font-medium">
						<iconify-icon icon="ri:computer-line" width="20" height="20" class="mr-2"></iconify-icon>
						<span class="">Tambah Komputer</span>
					</a>
				</form>
			</div>
		</div>

		<div class=" rounded-lg border-2 border-slate-800 overflow-x-auto">
			<table class="min-w-full font-medium">
				<thead class="bg-slate-800 text-white font-normal">
					<tr class="text-left text-sm">
						<th class="py-3 px-4 font-medium">No</th>
						@foreach($columns as $col => $label)
							<th class="py-3 px-4">
								<a href="{{ sortUrl($col, $sort ?? 'id', $direction ?? 'asc') }}"
									class="flex items-center gap-1 group font-medium">
									{{ $label }}
									<span class="flex flex-col ml-1">
										<iconify-icon icon="mdi:arrow-up" width="14" height="14" @if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'asc') class="text-white" @else
										class="text-[#A1A1A1] opacity-40 group-hover:opacity-80" @endif></iconify-icon>
										<iconify-icon icon="mdi:arrow-down" width="14" height="14" @if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'desc') class="text-white" @else
										class="text-[#A1A1A1] opacity-40 group-hover:opacity-80" @endif></iconify-icon>
									</span>
								</a>
							</th>
						@endforeach
						<th class="py-3 px-4 font-medium">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($komputers as $komputer)
						<tr>
							<td class="py-3 px-4 font-medium text-slate-800">
								{{ $loop->iteration + $komputers->firstItem() - 1 }}
							</td>
							<td class="py-3 px-4 font-medium text-slate-800">{{ $komputer->ruangan }}</td>
							<td class="py-3 px-4 text-slate-800">{{ ucfirst(str_replace('_', ' ', $komputer->unit)) }}</td>
							<td class="py-3 px-4 text-slate-800">{{ $komputer->brand }}</td>
							<td class="py-3 px-4 text-slate-800">{{ $komputer->tahun }}</td>
							<td class="py-3 px-4 text-slate-800">{{ $komputer->os }}</td>
							<td class="py-3 px-4 flex gap-4">
								<a href="{{ route('komputer.show', $komputer->id) }}" title="Detail">
									<iconify-icon width="20" height="20" icon="lucide:info"
										class="text-slate-800 hover:text-blue-500 transition-colors duration-200"></iconify-icon>
								</a>
								<a href="{{ route('komputer.edit', $komputer->id) }}" title="Edit">
									<iconify-icon width="20" height="20" icon="lucide:edit"
										class="text-slate-800 hover:text-yellow-500 transition-colors duration-200"></iconify-icon>
								</a>
								<form action="{{ route('komputer.destroy', $komputer->id) }}" method="POST" class="inline">
									@csrf
									@method('DELETE')
									<button type="submit" class="cursor-pointer" title="Hapus"
										onclick="return confirm('Yakin ingin menghapus data komputer ini?')">
										<iconify-icon width="20" height="20" icon="lucide:trash"
											class="text-slate-800 hover:text-red-500 transition-colors duration-200"></iconify-icon>
									</button>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="6" class="py-8 px-4 text-center text-dark-text-secondary">Tidak ada komputer ditemukan.
							</td>
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