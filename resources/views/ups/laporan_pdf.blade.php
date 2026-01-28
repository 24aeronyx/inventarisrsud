@extends('layouts.laporan')

@section('title', 'Laporan Data UPS RSUD dr. Abdul Rivai')

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
			@forelse($data as $ups)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $ups->ruangan }}</td>
				<td>{{ $ups->brand }}</td>
				<td>{{ $ups->kegiatan }}</td>
				<td>{{ $ups->tahun }}</td>
			</tr>
			@empty
			<tr class="no-data-row">
				<td colspan="4">
					Tidak ada data UPS ditemukan.
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>
@endsection
