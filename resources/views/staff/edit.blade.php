@extends('layouts.dashboard')
@section('content')
	<div class="p-8 rounded-lg border-2 border-slate-200 bg-slate-200">
		<h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Staff</h2>
		<form action="{{ route('staff.update', $staff->id) }}" method="POST" autocomplete="off">
			@csrf
			@method('PUT')
			<div class="flex flex-col lg:flex-row gap-4 items-center">
				<div class="mb-4 w-full">
					<x-input name="name" type="text" placeholder="Nama Lengkap"
						class="bg-slate-100 text-slate-800 placeholder:text-gray-500" icon="mdi:user" :value="old('name', $staff->name)" required />

				</div>

				<div class="mb-4 w-full">
					<x-input name="username" type="text" placeholder="Username"
						class="bg-slate-100 text-slate-800 placeholder:text-gray-500" icon="mdi:account"
						:value="old('username', $staff->username)" required />

				</div>
			</div>

			<div class="flex flex-col lg:flex-row gap-4 items-center">
				<div class="mb-4 w-full">
					<x-input name="password" type="password" class="bg-slate-100 text-slate-800 placeholder:text-gray-500"
						placeholder="Password (isi jika ingin mengubah)" icon="mdi:lock" />

				</div>

				<div class="mb-4 w-full">
					<x-input name="password_confirmation" type="password" placeholder="Konfirmasi Password"
						class="bg-slate-100 text-slate-800 placeholder:text-gray-500" icon="mdi:lock-check" />
				</div>
			</div>

			<div class="flex justify-end">
				<a href="{{ route('staff.index') }}"
					class="text-slate-800 bg-slate-400 font-medium mr-3 border-2 border-slate-400 flex items-center py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white duration-300 hover:border-slate-800">Kembali</a>
				<x-button type="submit" icon="gg:user" iconPosition="left" class="bg-slate-800 text-white">
					Simpan Perubahan
				</x-button>
			</div>
		</form>
	</div>
@endsection
@section('title', 'Manajemen Staff')
@section('page-title', 'Manajemen Staff')
@section('page-subtitle', 'Edit Staff RSUD')