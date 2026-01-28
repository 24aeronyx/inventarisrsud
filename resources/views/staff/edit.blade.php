@extends('layouts.dashboard')
@section('content')
<div class="p-8 rounded-lg shadow-lg border-2 border-[#262626]">
	<h2 class="text-2xl font-bold text-[#FFFFFF] mb-6">Edit Staff</h2>
	<form action="{{ route('staff.update', $staff->id) }}" method="POST" autocomplete="off">
		@csrf
		@method('PUT')
		<div class="flex flex-col lg:flex-row gap-4 items-center">
			<div class="mb-4 w-full">
				<x-input 
					name="name" 
					type="text" 
					placeholder="Nama Lengkap" 
					icon="mdi:user" 
					:value="old('name', $staff->name)" 
					required 
				/>
				
			</div>

			<div class="mb-4 w-full">
				<x-input 
					name="username" 
					type="text" 
					placeholder="Username" 
					icon="mdi:account" 
					:value="old('username', $staff->username)" 
					required 
				/>
				
			</div>
		</div>

		<div class="flex flex-col lg:flex-row gap-4 items-center"> 
			<div class="mb-4 w-full">
				<x-input 
					name="password" 
					type="password" 
					placeholder="Password (isi jika ingin mengubah)" 
					icon="mdi:lock" 
				/>
				
			</div>

			<div class="mb-4 w-full">
				<x-input 
					name="password_confirmation" 
					type="password" 
					placeholder="Konfirmasi Password" 
					icon="mdi:lock-check" 
				/>
			</div>
		</div>

		<div class="flex justify-end">
			<a href="{{ route('staff.index') }}" class="text-white mr-3 border-2 border-[#262626] flex items-center py-2 px-4 rounded-lg hover:bg-[#262626]">Kembali</a>
			<x-button type="submit" icon="gg:user" iconPosition="left">
				Simpan Perubahan
			</x-button>
		</div>
	</form>
</div>
@endsection
@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Edit Staff RSUD')
