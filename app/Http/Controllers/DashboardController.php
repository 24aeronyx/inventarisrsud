<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use App\Models\Komputer;
use App\Models\Printer;
use App\Models\SwitchHub;
use App\Models\Ups;
use App\Models\User;
use App\Models\Perbaikan;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = request('tahun', now()->year);
        $countKomputer = Komputer::count();
        $countPrinter = Printer::count();
        $countStaff = User::where('role', 'staff')->count();
        $countUps = Ups::count();
        $countSwitchhub = SwitchHub::count();
        $countCCTV = Cctv::count();

        // Data perbulan
        $perbaikanPerBulan = Perbaikan::selectRaw("MONTH(tgl) as bulan, COUNT(*) as total")
            ->whereYear('tgl', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('M', mktime(0, 0, 0, $i, 1)) . ' ' . $tahun;
            $item = $perbaikanPerBulan->firstWhere('bulan', $i);
            $data[] = $item ? $item->total : 0;
        }

        return view('dashboard.index', compact(
            'countKomputer',
            'countPrinter',
            'countStaff',
            'countUps',
            'countSwitchhub',
            'countCCTV',
            'labels',
            'data',
            'tahun'
        ));
    }
}
