@extends('layouts.dashboard')

@section('title', 'Manajemen UPS')
@section('page-title', 'Manajemen UPS')
@section('page-subtitle', 'Kelola Data UPS RSUD')

@section('content')
<div class="bg-slate-200 rounded-lg p-6">

    {{-- TOP BAR --}}
    <div class="flex items-center mb-6">
        <div class="relative w-full flex justify-between items-center flex-col md:flex-row">

            <form action="{{ route('ups.index') }}" method="GET"
                  class="lg:w-96 bg-slate-100 rounded-lg py-3 pl-3 pr-4 flex items-center">
                <iconify-icon icon="carbon:search" class="mr-3 text-slate-800"></iconify-icon>
                <input type="text"
                       name="query"
                       value="{{ request('query') }}"
                       placeholder="Cari UPS"
                       class="outline-none bg-transparent text-slate-800 placeholder:text-slate-500">
            </form>

            <a href="{{ route('ups.create') }}"
               class="flex items-center text-white bg-slate-800 font-medium
                      cursor-pointer rounded-lg py-3 px-4">
                <iconify-icon icon="mdi:thunder-outline" width="20" height="20" class="mr-2"></iconify-icon>
                <span>Tambah UPS</span>
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-slate-200 rounded-lg overflow-x-auto border-2 border-slate-800">
        <table class="min-w-full">

            <thead class="bg-slate-800">
                <tr class="text-left text-white text-sm font-medium">
                    <th class="py-3 px-4 font-medium">No</th>

                    @foreach($columns as $col => $label)
                        <th class="py-3 px-4 font-medium">
                            <a href="{{ sortUrl($col, $sort ?? 'id', $direction ?? 'asc') }}"
                               class="flex items-center gap-1 group">
                                {{ $label }}
                                <span class="flex flex-col ml-1">
                                    <iconify-icon
                                        icon="mdi:arrow-up"
                                        width="14" height="14"
                                        class="{{ ($sort ?? 'id') === $col && ($direction ?? 'asc') === 'asc'
                                            ? 'text-white'
                                            : 'text-[#A1A1A1] opacity-40 group-hover:opacity-80' }}">
                                    </iconify-icon>

                                    <iconify-icon
                                        icon="mdi:arrow-down"
                                        width="14" height="14"
                                        class="{{ ($sort ?? 'id') === $col && ($direction ?? 'asc') === 'desc'
                                            ? 'text-white'
                                            : 'text-[#A1A1A1] opacity-40 group-hover:opacity-80' }}">
                                    </iconify-icon>
                                </span>
                            </a>
                        </th>
                    @endforeach

                    <th class="py-3 px-4 font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($ups as $item)
                    <tr class="text-slate-800 font-medium">
                        <td class="py-3 px-4">
                            {{ $loop->iteration + $ups->firstItem() - 1 }}
                        </td>
                        <td class="py-3 px-4">{{ $item->ruangan }}</td>
                        <td class="py-3 px-4">{{ $item->brand }}</td>
                        <td class="py-3 px-4">{{ $item->tahun }}</td>
                        <td class="py-3 px-4">{{ $item->kegiatan }}</td>

                        <td class="py-3 px-4 flex justify-start items-center gap-4">
                            <a href="{{ route('ups.show', $item->id) }}" title="Detail">
                                <iconify-icon icon="lucide:info" width="20" height="20"
                                    class="text-slate-800 hover:text-blue-500 transition-colors duration-200">
                                </iconify-icon>
                            </a>

                            <a href="{{ route('ups.edit', $item->id) }}" title="Edit">
                                <iconify-icon icon="lucide:edit" width="20" height="20"
                                    class="text-slate-800 hover:text-yellow-500 transition-colors duration-200">
                                </iconify-icon>
                            </a>

                            <form action="{{ route('ups.destroy', $item->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus data UPS ini?')">
                                    <iconify-icon icon="lucide:trash" width="20" height="20"
                                        class="text-slate-800 hover:text-red-500 transition-colors duration-200">
                                    </iconify-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="py-8 px-4 text-center text-slate-500">
                            Tidak ada UPS ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $ups->links() }}
    </div>
</div>
@endsection
