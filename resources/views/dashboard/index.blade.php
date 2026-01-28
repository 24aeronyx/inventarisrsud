@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan informasi inventaris')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="rounded-xl p-6 border border-[#262626]">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-[#FFFFFF] mb-2">Selamat Datang!</h3>
                <p class="text-[#A1A1A1]">Kelola inventaris RSUD dr. Abdul Rivai dengan mudah dan efisien</p>
            </div>
            <img src="{{asset('/logo.png')}}" alt="logo" width="50" height="50">
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Komputer -->
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total Komputer</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countKomputer }}</p>
                </div>
                <div class="w-12 h-12 bg-[#061848] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:monitor" class=" text-[#0C4FF7]"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Total Printer -->
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total Printer</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countPrinter }}</p>
                </div>
                <div class="w-12 h-12 bg-[#064806] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:printer" class=" text-[#05FF05]"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Total UPS -->
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total UPS</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countUps }}</p>
                </div>
                <div class="w-12 h-12 bg-[#063148] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:flash" class=" text-[#0BAAFF]"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Total Staff -->
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total Staff</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countStaff }}</p>
                </div>
                <div class="w-12 h-12 bg-[#546B09] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:account-group" class=" text-[#C6FF09]"></iconify-icon>
                </div>
            </div>
        </div>
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total Switch</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countSwitchhub }}</p>
                </div>
                <div class="w-12 h-12 bg-[#60096b] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:switch" class=" text-[#da14f4]"></iconify-icon>
                </div>
            </div>
        </div>
        <div class="rounded-xl p-6 border border-[#262626] hover:border-[#A1A1A1] transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#A1A1A1] text-sm font-medium">Total CCTV</p>
                    <p class="text-2xl font-bold text-[#FFFFFF] mt-1">{{ $countCCTV }}</p>
                </div>
                <div class="w-12 h-12 bg-[#6b090b] rounded-lg flex items-center justify-center">
                    <iconify-icon icon="mdi:cctv" class=" text-[#f61417]"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Aset -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Bar Chart -->
        <div class="rounded-xl p-6 border border-[#262626]">
            <h3 class="text-lg font-semibold text-[#FFFFFF] mb-4">Jumlah Aset per Kategori</h3>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Pie Chart -->
        <div class="rounded-xl p-6 border border-[#262626] h-[50vh] flex flex-col items-center justify-center">
            <h3 class="text-lg font-semibold text-[#FFFFFF] mb-4 mt-8 self-start">Proporsi Aset</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <!-- Line Chart Perbaikan Per Bulan -->
    <div class="rounded-xl p-6 border border-[#262626] mt-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-[#FFFFFF]">Statistik Jumlah Perbaikan</h3>
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('dashboard') }}" class="inline">
                    <input type="hidden" name="tahun" value="{{ $tahun - 1 }}">
                    <button type="submit" class="bg-[#262626] text-white px-3 py-1 rounded hover:bg-[#444]" title="Tahun Sebelumnya">
                        <iconify-icon icon="mdi:chevron-left" width="24" height="24"></iconify-icon>
                    </button>
                </form>
                <span class="text-white font-bold text-lg">{{ $tahun }}</span>
                <form method="GET" action="{{ route('dashboard') }}" class="inline">
                    <input type="hidden" name="tahun" value="{{ $tahun + 1 }}">
                    <button type="submit" class="bg-[#262626] text-white px-3 py-1 rounded hover:bg-[#444]" title="Tahun Berikutnya">
                        <iconify-icon icon="mdi:chevron-right" width="24" height="24"></iconify-icon>
                    </button>
                </form>
            </div>
        </div>
        <canvas id="lineChartPerbaikan" height="100"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const data = {
            komputer: {{ $countKomputer }},
            printer: {{ $countPrinter }},
            ups: {{ $countUps }},
            staff: {{ $countStaff }},
            switchhub: {{ $countSwitchhub }},
            cctv: {{ $countCCTV }}
        };
        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Komputer', 'Printer', 'UPS', 'Staff', 'SwitchHub', 'CCTV'],
                datasets: [{
                    label: 'Jumlah',
                    data: [data.komputer, data.printer, data.ups, data.staff, data.switchhub, data.cctv],
                    backgroundColor: ['#061848', '#064806', '#063148', '#546B09', '#60096b', '#6b090b'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Pie Chart
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Komputer', 'Printer', 'UPS', 'Staff', 'SwitchHub', 'CCTV'],
                datasets: [{
                    data: [data.komputer, data.printer, data.ups, data.staff, data.switchhub, data.cctv],
                    backgroundColor: ['#061848', '#064806', '#063148', '#546B09', '#60096b', '#6b090b'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: '#A1A1A1' }
                    },
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold' },
                        formatter: (value, ctx) => {
                            let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / sum) * 100).toFixed(1) + '%';
                            return percentage;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Line Chart Perbaikan per Bulan
        new Chart(document.getElementById('lineChartPerbaikan'), {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Perbaikan',
                    data: @json($data),
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56,189,248,0.2)',
                    pointBackgroundColor: '#38bdf8',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff',
                            font: { weight: 'bold' }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#fff' },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#fff' },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    }
                }
            }
        });
    });
</script>
@endpush
