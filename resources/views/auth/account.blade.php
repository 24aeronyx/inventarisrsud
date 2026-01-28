@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626]">
    <h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Akun Saya</h2>
    <div class="mb-8 bg-[#262626] rounded-lg p-6 text-white flex flex-col gap-3">
        <div class="flex items-center gap-3">
            <span class="inline-block text-xl"><iconify-icon icon="mdi:account" /></span>
            <span class="font-semibold w-24">Username</span>
            <span>{{ $user->username }}</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-block text-xl"><iconify-icon icon="mdi:user" /></span>
            <span class="font-semibold w-24">Nama</span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-block text-xl"><iconify-icon icon="mdi:shield-account" /></span>
            <span class="font-semibold w-24">Role</span>
            <span>{{ $user->role ?? '-' }}</span>
        </div>
    </div>
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#FFFFFF] mb-4">Ganti Nama</h3>
        <form action="{{ route('account.change-name') }}" method="POST" autocomplete="off" class="flex gap-2 items-center flex-col md:flex-row">
            @csrf
            <x-input name="name" type="text" placeholder="Nama Baru" icon="mdi:user" :value="$user->name" required />
            <x-button type="submit" icon="mdi:account-edit" iconPosition="left" class="w-62">Ganti Nama</x-button>
        </form>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <h3 class="text-lg font-bold text-[#FFFFFF] mb-4">Ganti Password</h3>
        <form action="{{ route('account.change-password') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-4">
                <x-input name="current_password" type="password" placeholder="Password Saat Ini" icon="mdi:lock" required />
                @error('current_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <x-input name="new_password" type="password" placeholder="Password Baru" icon="mdi:lock" required />
                @error('new_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <x-input name="new_password_confirmation" type="password" placeholder="Konfirmasi Password Baru" icon="mdi:lock-check" required />
            </div>
            <div class="flex justify-end">
                <x-button type="submit" icon="mdi:lock-reset" iconPosition="left">Ganti Password</x-button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('title', 'Akun Saya')
@section('page-title', 'Akun Saya')
@section('page-subtitle', 'Pengaturan Akun RSUD')
