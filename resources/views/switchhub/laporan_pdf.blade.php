@extends('layouts.laporan')

@section('title', 'Laporan Data Switch RSUD dr. Abdul Rivai')

@section('content')
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Ruangan</th>
				<th>Brand</th>
				<th>Kegiatan</th>
				<th>Tahun</th>
			</tr>
		</thead>
		<tbody>
			@forelse($data as $switchhub)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $switchhub->ruangan }}</td>
				<td>{{ $switchhub->brand }}</td>
				<td>{{ $switchhub->kegiatan }}</td>
				<td>{{ $switchhub->tahun }}</td>
			</tr>
			@empty
			<tr class="no-data-row">
				<td colspan="4">
					Tidak ada data Switch ditemukan.
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>
@endsection
