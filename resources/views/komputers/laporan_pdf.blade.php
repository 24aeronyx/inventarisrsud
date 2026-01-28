@extends('layouts.laporan')

@section('title', 'Laporan Data Komputer RSUD dr. Abdul Rivai')

@section('content')
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Unit</th>
                <th>Brand</th>
                <th>Processor</th>
                <th>RAM</th>
                <th>Storage</th>
                <th>OS</th>
                <th>IP Address</th>
                <th>Kegiatan</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $komputer)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $komputer->ruangan }}</td>
                <td>{{ $komputer->unit }}</td>
                <td>{{ $komputer->brand }}</td>
                <td>{{ $komputer->processor }}</td>
                <td>{{ $komputer->ram }}</td>
                <td>{{ $komputer->storage_type }} {{ $komputer->storage_capacity }}</td>
                <td>{{ $komputer->os }}</td>
                <td>{{ $komputer->ip_address }}</td>
                <td>{{ $komputer->kegiatan }}</td>
                <td>{{ $komputer->tahun }}</td>
            </tr>
            @empty
            <tr class="no-data-row">
                <td colspan="10">
                    Tidak ada data komputer ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection