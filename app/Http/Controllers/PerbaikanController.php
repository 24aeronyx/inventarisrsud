<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perbaikan;
use App\Models\Komputer;
use App\Models\Ups;
use App\Models\Printer;
use App\Models\Cctv;
use App\Models\SwitchHub;
use Barryvdh\DomPDF\Facade\Pdf;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $perbaikans = Perbaikan::where(function ($q) use ($query) {
            if ($query) {
                $q->where('keterangan', 'like', "%{$query}%");
            }
        })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['query' => $query, 'sort' => $sort, 'direction' => $direction]);

        $columns = [
            'tgl' => 'Tanggal',
        ];

        return view('perbaikans.index', compact('perbaikans', 'sort', 'direction', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua aset untuk pilihan
        $komputers = Komputer::all();
        $ups = Ups::all();
        $printers = Printer::all();
        $cctvs = Cctv::all();
        $switches = SwitchHub::all();
        return view('perbaikans.create', compact('komputers', 'ups', 'printers', 'cctvs', 'switches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_type' => 'required|string',
            'asset_id' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        Perbaikan::create([
            'tgl' => now()->toDateString(),
            'asset_type' => $request->asset_type,
            'asset_id' => $request->asset_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('perbaikan.index')->with('success', 'Perbaikan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikans.show', compact('perbaikan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $komputers = Komputer::all();
        $ups = Ups::all();
        $printers = Printer::all();
        $cctvs = Cctv::all();
        $switches = SwitchHub::all();
        return view('perbaikans.edit', compact('perbaikan', 'komputers', 'ups', 'printers', 'cctvs', 'switches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $request->validate([
            'tgl' => 'required|date',
            'asset_type' => 'required|string',
            'asset_id' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        $perbaikan->update([
            'tgl' => $request->tgl,
            'asset_type' => $request->asset_type,
            'asset_id' => $request->asset_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('perbaikan.index')->with('success', 'Perbaikan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();
        return redirect()->route('perbaikan.index')->with('success', 'Perbaikan berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = Perbaikan::query();

        if ($request->filled('asset_type')) {
            $query->where('asset_type', $request->asset_type);
        }
        if ($request->filled('tgl')) {
            $query->where('tgl', $request->tgl);
        }
        if ($request->filled('keterangan')) {
            $query->where('keterangan', 'like', "%{$request->keterangan}%");
        }

        $data = $query->get();

        $pdf = Pdf::loadView('perbaikans.laporan_pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan_perbaikan.pdf');
    }

    public function laporan(Request $request)
    {
        $query = Perbaikan::query();

        if ($request->filled('asset_type')) {
            $query->where('asset_type', $request->asset_type);
        }
        if ($request->filled('tgl')) {
            $query->where('tgl', $request->tgl);
        }
        if ($request->filled('keterangan')) {
            $query->where('keterangan', 'like', "%{$request->keterangan}%");
        }

        $data = $query->paginate(10);

        $asset_types = Perbaikan::select('asset_type')->distinct()->pluck('asset_type');
        $tgls = Perbaikan::select('tgl')->distinct()->pluck('tgl');

        return view('perbaikans.laporan', compact('data', 'asset_types', 'tgls'));
    }
}
