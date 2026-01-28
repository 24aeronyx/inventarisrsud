<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cctv;
use Barryvdh\DomPDF\Facade\Pdf;

class CctvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $cctvs = Cctv::where(function ($q) use ($query) {
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

        return view('cctv.index', compact('cctvs', 'columns', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = $this->ruangan ?? config('ruangan');
        return view('cctv.create', compact('ruangan'));
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

        Cctv::create($request->all());
        return redirect()->route('cctv.index')->with('success', 'CCTV berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cctv = Cctv::findOrFail($id);
        return view('cctv.show', compact('cctv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = $this->ruangan ?? config('ruangan');
        $cctv = Cctv::findOrFail($id);
        return view('cctv.edit', compact('cctv', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cctv = Cctv::findOrFail($id);

        $request->validate([
            'ruangan'  => 'required|string|max:255',
            'brand'    => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tahun'    => 'required|integer|digits:4',
        ]);

        $cctv->update($request->all());

        return redirect()->route('cctv.index')->with('success', 'CCTV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cctv = Cctv::findOrFail($id);
        $cctv->delete();

        return redirect()->route('cctv.index')->with('success', 'CCTV berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = Cctv::query();

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

        $pdf = Pdf::loadView('cctv.laporan_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_cctv.pdf');
    }

    public function laporan(Request $request)
    {
        $query = Cctv::query();

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
        $brands = Cctv::select('brand')->distinct()->pluck('brand');
        $kegiatans = Cctv::select('kegiatan')->distinct()->pluck('kegiatan');
        $tahuns = Cctv::select('tahun')->distinct()->pluck('tahun');
        $ruangan = config('ruangan');

        return view('cctv.laporan', compact('data', 'brands', 'kegiatans', 'tahuns', 'ruangan'));
    }
}
