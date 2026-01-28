@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626]">
	<h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Tambah Staff</h2>
	<form action="{{ route('staff.store') }}" method="POST" autocomplete="off">
		@csrf
		<div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="mb-4 w-full">
                <x-input 
                    name="name" 
                    type="text" 
                    placeholder="Nama Lengkap" 
                    icon="mdi:user" 
                    :value="old('name')" 
                    required 
                />
                
            </div>

            <div class="mb-4 w-full">
                <x-input 
                    name="username" 
                    type="text" 
                    placeholder="Username" 
                    icon="mdi:account" 
                    :value="old('username')" 
                    required 
                />
                
            </div>
        </div>

		<div class="flex flex-col lg:flex-row gap-4 items-center"> 
            <div class="mb-4 w-full">
                <x-input 
                    name="password" 
                    type="password" 
                    placeholder="Password" 
                    icon="mdi:lock" 
                    required 
                />
                
            </div>

            <div class="mb-4 w-full">
                <x-input 
                    name="password_confirmation" 
                    type="password" 
                    placeholder="Konfirmasi Password" 
                    icon="mdi:lock-check" 
                    required 
                />
            </div>
        </div>

		<div class="flex justify-end">
            <a href="{{ route('staff.index') }}" class="text-white mr-3 border-2 border-[#262626] flex items-center py-2 px-4 rounded-lg hover:bg-[#262626]">Kembali</a>
			<x-button type="submit" icon="gg:user" iconPosition="left">
				Tambah Staff
			</x-button>
		</div>
	</form>
</div>
@endsection
@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Tambah Staff RSUD')
