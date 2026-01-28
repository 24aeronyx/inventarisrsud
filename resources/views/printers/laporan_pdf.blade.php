@extends('layouts.laporan')

@section('title', 'Laporan Data Printer RSUD dr. Abdul Rivai')

@section('content')
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Brand</th>
                <th>Jenis</th>
                <th>Kegiatan</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $printer)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $printer->ruangan }}</td>
                <td>{{ $printer->brand }}</td>
                <td>{{ $printer->jenis }}</td>
                <td>{{ $printer->kegiatan }}</td>
                <td>{{ $printer->tahun }}</td>
            </tr>
            @empty
            <tr class="no-data-row">
                <td colspan="5">
                    Tidak ada data printer ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
