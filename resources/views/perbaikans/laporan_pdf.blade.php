@extends('layouts.laporan')

@section('title', 'Laporan Data Perbaikan Aset RSUD dr. Abdul Rivai')

@section('content')
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Jenis Aset</th>
				<th>Ruangan</th>
				<th>Tahun</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@forelse($data as $perbaikan)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $perbaikan->tgl }}</td>
				<td>{{ class_basename($perbaikan->asset_type) }}</td>
				<td>{{ optional($perbaikan->asset)->ruangan ?? optional($perbaikan->asset)->nama ?? '-' }}</td>
				<td>{{ optional($perbaikan->asset)->tahun ?? '-' }}</td>
				<td>{{ $perbaikan->keterangan }}</td>
			</tr>
			@empty
			<tr class="no-data-row">
				<td colspan="6">
					Tidak ada data perbaikan ditemukan.
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>
@endsection
