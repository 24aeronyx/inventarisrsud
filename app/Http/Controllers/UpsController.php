<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ups;
use Barryvdh\DomPDF\Facade\Pdf;

class UpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $ups = Ups::where(function ($q) use ($query) {
            $q->where('ruangan', 'like', "%{$query}%")
                ->orWhere('brand', 'like', "%{$query}%")
                ->orWhere('tahun', 'like', "%{$query}%")
                ->orWhere('kegiatan', 'like', "%{$query}%");
        })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['query' =>  $query, 'sort' => $sort, 'direction' => $direction]);

        $columns = [
            'ruangan' => 'Ruangan',
            'brand' => 'Brand',
            'tahun' => 'Tahun',
            'kegiatan' => 'Kegiatan',
        ];

        return view('ups.index', compact('ups', 'columns', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = $this->ruangan;
        return view('ups.create', compact('ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan'  => 'required|string|max:255',
            'brand'    => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
        ]);

        Ups::create($request->all());
        return redirect()->route('ups.index')->with('success', 'UPS berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ups = Ups::findOrFail($id);
        return view('ups.show', compact('ups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = $this->ruangan;
        $ups = Ups::findOrFail($id);
        return view('ups.edit', compact('ups', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ups = Ups::findOrFail($id);

        $request->validate([
            'ruangan'  => 'required|string|max:255',
            'brand'    => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tahun'    => 'required|integer|digits:4',
        ]);

        $ups->update($request->all());

        return redirect()->route('ups.index')->with('success', 'UPS berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ups = Ups::findOrFail($id);
        $ups->delete();

        return redirect()->route('ups.index')->with('success', 'UPS berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = Ups::query();

        if ($request->filled('ruangan')) {
            $query->where('ruangan', 'like', "%{$request->ruangan}%");
        }
        if ($request->filled('tahun')) {
            $query->where('tahun', 'like', "%{$request->tahun}%");
        }
        if ($request->filled('kegiatan')) {
            $query->where('kegiatan', 'like', "%{$request->kegiatan}%");
        }
        if ($request->filled('brand')) {
            $query->where('brand', 'like', "%{$request->brand}%");
        }

        $data = $query->get();

        $pdf = Pdf::loadView('ups.laporan_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_ups.pdf');
    }

    public function laporan(Request $request)
    {
        $query = Ups::query();

        if ($request->filled('ruangan')) {
            $query->where('ruangan', 'like', "%{$request->ruangan}%");
        }
        if ($request->filled('tahun')) {
            $query->where('tahun', 'like', "%{$request->tahun}%");
        }
        if ($request->filled('kegiatan')) {
            $query->where('kegiatan', 'like', "%{$request->kegiatan}%");
        }
        if ($request->filled('brand')) {
            $query->where('brand', 'like', "%{$request->brand}%");
        }

        $data = $query->paginate(10);
        $brands = Ups::select('brand')->distinct()->pluck('brand');
        $kegiatans = Ups::select('kegiatan')->distinct()->pluck('kegiatan');
        $tahuns = Ups::select('tahun')->distinct()->pluck('tahun');
        $ruangan = config('ruangan');

        return view('ups.laporan', compact('data', 'brands', 'kegiatans', 'tahuns', 'ruangan'));
    }
}
