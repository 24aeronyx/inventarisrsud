@extends('layouts.dashboard')
@section('content')
    <div class="p-8 rounded-lg border-2 bg-slate-200 border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Tambah Staff</h2>
        <form action="{{ route('staff.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="mb-4 w-full">
                    <x-input name="name" type="text" class="bg-slate-100 text-slate-800 placeholder:text-gray-500"
                        placeholder="Nama Lengkap" icon="mdi:user" :value="old('name')" required />

                </div>

                <div class="mb-4 w-full">
                    <x-input name="username" type="text" class="bg-slate-100 text-slate-800 placeholder:text-gray-500"
                        placeholder="Username" icon="mdi:account" :value="old('username')" required />

                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="mb-4 w-full">
                    <x-input name="password" type="password" class="bg-slate-100 text-slate-800 placeholder:text-gray-500"
                        placeholder="Password" icon="mdi:lock" required />

                </div>

                <div class="mb-4 w-full">
                    <x-input name="password_confirmation" type="password"
                        class="bg-slate-100 text-slate-800 placeholder:text-gray-500" placeholder="Konfirmasi Password"
                        icon="mdi:lock-check" required />
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('staff.index') }}"
                    class="text-white mr-3 font-medium border-1 border-slate-300 flex items-center py-2 px-4 rounded-lg bg-slate-300 hover:bg-slate-800 hover:text-white duration-300">Kembali</a>
                <x-button type="submit" icon="gg:user" iconPosition="left"
                    class="bg-slate-800 text-white">
                    Tambah Staff
                </x-button>
            </div>
        </form>
    </div>
@endsection
@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Tambah Staff RSUD')