@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan informasi inventaris')

@section('content')
    @php
        $stats = [
            [
                'label' => 'Total Komputer',
                'count' => $countKomputer,
                'icon' => 'mdi:monitor',
                'bg' => '#061848',
                'url' => '/dashboard/komputer',
            ],
            [
                'label' => 'Total Printer',
                'count' => $countPrinter,
                'icon' => 'mdi:printer',
                'bg' => '#064806',
                'url' => '/dashboard/printer',
            ],
            [
                'label' => 'Total UPS',
                'count' => $countUps,
                'icon' => 'mdi:flash',
                'bg' => '#063148',
                'url' => '/dashboard/ups',
            ],
            [
                'label' => 'Total Staff',
                'count' => $countStaff,
                'icon' => 'mdi:account-group',
                'bg' => '#546B09',
                'url' => '/dashboard/staff',
            ],
            [
                'label' => 'Total Switch',
                'count' => $countSwitchhub,
                'icon' => 'mdi:switch',
                'bg' => '#60096b',
                'url' => '/dashboard/switch',
            ],
            [
                'label' => 'Total CCTV',
                'count' => $countCCTV,
                'icon' => 'mdi:cctv',
                'bg' => '#6b090b',
                'url' => '/dashboard/cctv',
            ],
        ];
    @endphp
    <div class="space-y-6 bg-slate-100">
        <!-- Welcome Card -->
        <div class="rounded-xl p-6 border border-slate-200 bg-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Selamat Datang!</h3>
                    <p class="text-gray-500">Kelola inventaris RSUD dr. Abdul Rivai dengan mudah dan efisien</p>
                </div>
                <img src="{{asset('/logo.png')}}" alt="logo" width="50" height="50">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($stats as $stat)
                <a href="{{ $stat['url'] }}" class="group block rounded-xl p-6 border border-slate-200 bg-slate-200
                          hover:bg-slate-300 hover:shadow-sm
                          transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-slate-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium
                                      group-hover:text-slate-800 transition-colors">
                                {{ $stat['label'] }}
                            </p>
                            <p class="text-2xl font-bold text-gray-500 mt-1
                                      group-hover:text-slate-800 transition-colors">
                                {{ $stat['count'] }}
                            </p>
                        </div>

                        <div class="w-12 h-12 rounded-lg flex items-center justify-center"
                            style="background-color: {{ $stat['bg'] }}">
                            <iconify-icon icon="{{ $stat['icon'] }}" class="text-white text-2xl">
                            </iconify-icon>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Charts Aset -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Bar Chart -->
            <div class="rounded-xl p-6 border border-slate-200 bg-slate-200">
                <h3 class="text-lg font-semibold text-gray-500 mb-4">Jumlah Aset per Kategori</h3>
                <canvas id="barChart"></canvas>
            </div>

            <!-- Pie Chart -->
            <div
                class="rounded-xl p-6 border border-slate-200 bg-slate-200 h-[50vh] flex flex-col items-center justify-center">
                <h3 class="text-lg font-semibold text-gray-500 mb-4 mt-8 self-start">Proporsi Aset</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <!-- Line Chart Perbaikan Per Bulan -->
        <div class="rounded-xl p-6 border border-slate-200 bg-slate-200 mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-500">Statistik Jumlah Perbaikan</h3>
                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('dashboard') }}" class="inline">
                        <input type="hidden" name="tahun" value="{{ $tahun - 1 }}">
                        <button type="submit"
                            class="flex justify-center items-center bg-slate-400 text-white px-3 py-1 rounded hover:bg-[#444]"
                            title="Tahun Sebelumnya">
                            <iconify-icon icon="mdi:chevron-left" width="24" height="24"></iconify-icon>
                        </button>
                    </form>
                    <span class="text-gray-500 font-bold text-lg">{{ $tahun }}</span>
                    <form method="GET" action="{{ route('dashboard') }}" class="inline">
                        <input type="hidden" name="tahun" value="{{ $tahun + 1 }}">
                        <button type="submit"
                            class="flex justify-center items-center bg-slate-400 text-white px-3 py-1 rounded hover:bg-[#444]"
                            title="Tahun Berikutnya">
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
        document.addEventListener('DOMContentLoaded', function () {
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
                                color: '#6B7280',
                                font: { weight: 'bold' }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#6B7280' },
                            grid: { color: 'rgba(203,213,225,0.4)' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#6B7280' },
                            grid: { color: 'rgba(203,213,225,0.4)' }
                        }
                    }
                }
            });
        });
    </script>
@endpush