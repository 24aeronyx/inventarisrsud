@extends('layouts.laporan')

@section('title', 'Laporan Data CCTV RSUD dr. Abdul Rivai')

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
			@forelse($data as $cctv)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $cctv->ruangan }}</td>
				<td>{{ $cctv->brand }}</td>
				<td>{{ $cctv->kegiatan }}</td>
				<td>{{ $cctv->tahun }}</td>
			</tr>
			@empty
			<tr class="no-data-row">
				<td colspan="4">
					Tidak ada data CCTV ditemukan.
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>
@endsection
