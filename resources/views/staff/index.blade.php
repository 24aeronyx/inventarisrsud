@extends('layouts.dashboard')

@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Kelola Data Staff RSUD')

@section('content')
    <div class="bg-dark-bg-card rounded-lg shadow-md border-2 border-[#262626] p-6">
        <div class="flex items-center mb-6">
            <div class="relative w-full flex justify-between items-center flex-col md:flex-row ">
                <form action="{{ route('staff.index') }}" method="GET"
                    class="lg:w-96 bg-[#262626] rounded-lg py-3 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200 flex items-center">
                    <iconify-icon icon="carbon:search" class="mr-3"></iconify-icon>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari staff..."
                        class="outline-none bg-transparent text-white placeholder:text-dark-text-secondary">
                </form>
                <a href="{{ route('staff.create') }}"
                    class="flex items-center bg-[#FFFFFF] text-[#0A0A0A] hover:bg-[#A1A1A1] focus:ring-[#FFFFFF] cursor-pointer rounded-lg py-3 px-4 transition-colors duration-200">
                    <iconify-icon icon="gg:user" width="20" height="20" class="mr-2"></iconify-icon>
                    <span class="font-bold">Tambah Staff</span>
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
                                <a href="{{ sortUrl($col, $sort ?? 'id', $direction ?? 'asc') }}"
                                    class="flex items-center gap-1 group">
                                    {{ $label }}
                                    <span class="flex flex-col ml-1">
                                        <iconify-icon icon="mdi:arrow-up" width="14" height="14" @if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'asc') class="text-blue-500" @else
                                        class="text-[#A1A1A1] opacity-40 group-hover:opacity-80" @endif></iconify-icon>
                                        <iconify-icon icon="mdi:arrow-down" width="14" height="14" @if(($sort ?? 'id') === $col && ($direction ?? 'asc') === 'desc') class="text-blue-500" @else
                                        class="text-[#A1A1A1] opacity-40 group-hover:opacity-80" @endif></iconify-icon>
                                    </span>
                                </a>
                            </th>
                        @endforeach
                        <th class="py-3 px-4 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $staff)
                        <tr class="border-t border-[#262626] hover:bg-[#262626] transition-colors duration-200">
                            <td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $loop->iteration + $staffs->firstItem() - 1  }}
                            </td>
                            <td class="py-3 px-4 text-[#A1A1A1]">{{ $staff->role }}</td>
                            <td class="py-3 px-4 font-medium text-[#A1A1A1]">{{ $staff->name }}</td>
                            <td class="py-3 px-4 text-[#A1A1A1]">{{ $staff->username }}</td>

                            <td class="py-3 px-4 space-x-8">
                                <a href="{{route('staff.edit', $staff->id)}}">
                                    <iconify-icon width="20" height="20" icon="lucide:edit"
                                        class="text-[#A1A1A1] hover:text-yellow-500 transition-colors duration-200"></iconify-icon>
                                </a>
                                <form action="{{route('staff.destroy', $staff->id)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cursor-pointer"
                                        onclick="return confirm('Yakin ingin menghapus data staff ini?')">
                                        <iconify-icon width="20" height="20" icon="lucide:trash"
                                            class="text-[#A1A1A1] hover:text-red-500 transition-colors duration-200"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-dark-text-secondary">Tidak ada staff ditemukan.
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