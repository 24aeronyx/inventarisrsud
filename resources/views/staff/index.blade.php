@extends('layouts.dashboard')

@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Kelola Data Staff RSUD')

@section('content')
    <div class="rounded-lg bg-slate-200 p-6">
        <div class="flex items-center mb-6">
            <div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
                <form action="{{ route('staff.index') }}" method="GET"
                    class="lg:w-96 bg-slate-100 rounded-lg py-3 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200 flex items-center text-slate-800">
                    <iconify-icon icon="carbon:search" class="mr-3"></iconify-icon>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari staff"
                        class="outline-none bg-transparent text-slate-800 placeholder:text-slate-500">
                </form>
                <a href="{{ route('staff.create') }}"
                    class="flex items-center bg-slate-800 text-white cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200">
                    <iconify-icon icon="gg:user" width="20" height="20" class="mr-2"></iconify-icon>
                    <span class="font-medium">Tambah Staff</span>
                </a>
            </div>
        </div>

        <div class="bg-dark-bg-main rounded-lg overflow-x-auto bg-slate-800 border-2 border-slate-800">
            <table class="min-w-full ">
                <thead class="font-medium">
                    <tr class="text-left text-white text-sm">
                        <th class="py-3 px-4 font-medium">No</th>
                        @foreach($columns as $col => $label)
                            <th class="py-3 px-4 font-medium">
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
                    @forelse($staffs as $staff)
                        <tr class="bg-slate-200 transition-colors duration-200">
                            <td class="py-3 px-4 font-medium text-slate-800]">{{ $loop->iteration + $staffs->firstItem() - 1  }}
                            </td>
                            <td class="py-3 px-4 font-medium text-slate-800">{{ $staff->role }}</td>
                            <td class="py-3 px-4 font-medium text-slate-800">{{ $staff->name }}</td>
                            <td class="py-3 px-4 font-medium text-slate-800">{{ $staff->username }}</td>

                            <td class="py-3 px-4 flex justify-start items-center gap-4">
                                <a href="{{route('staff.edit', $staff->id)}}">
                                    <iconify-icon width="20" height="20" icon="lucide:edit"
                                        class="text-slate-800 hover:text-yellow-400 transition-colors duration-200"></iconify-icon>
                                </a>
                                <form action="{{route('staff.destroy', $staff->id)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cursor-pointer"
                                        onclick="return confirm('Yakin ingin menghapus data staff ini?')">
                                        <iconify-icon width="20" height="20" icon="lucide:trash"
                                            class="text-slate-800 hover:text-red-500 transition-colors duration-200"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 px-4 text-center text-white">Tidak ada staff ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $staffs->links() }}
        </div>
    </div>
@endsection