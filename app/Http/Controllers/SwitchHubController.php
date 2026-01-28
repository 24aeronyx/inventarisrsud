<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SwitchHub;

class SwitchHubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $switchhubs = SwitchHub::where(function ($q) use ($query) {
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

        return view('switchhub.index', compact('switchhubs', 'columns', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = $this->ruangan ?? config('ruangan');
        return view('switchhub.create', compact('ruangan'));
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

        SwitchHub::create($request->all());
        return redirect()->route('switch.index')->with('success', 'Switch/Hub berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $switchhub = SwitchHub::findOrFail($id);
        return view('switchhub.show', compact('switchhub'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = $this->ruangan ?? config('ruangan');
        $switchhub = SwitchHub::findOrFail($id);
        return view('switchhub.edit', compact('switchhub', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $switchhub = SwitchHub::findOrFail($id);

        $request->validate([
            'ruangan'  => 'required|string|max:255',
            'brand'    => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tahun'    => 'required|integer|digits:4',
        ]);

        $switchhub->update($request->all());

        return redirect()->route('switch.index')->with('success', 'Switch/Hub berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $switchhub = SwitchHub::findOrFail($id);
        $switchhub->delete();

        return redirect()->route('switch.index')->with('success', 'Switch/Hub berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = SwitchHub::query();

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

        $pdf = Pdf::loadView('switchhub.laporan_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_switchhub.pdf');
    }

    public function laporan(Request $request)
    {
        $query = SwitchHub::query();

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
        $brands = SwitchHub::select('brand')->distinct()->pluck('brand');
        $kegiatans = SwitchHub::select('kegiatan')->distinct()->pluck('kegiatan');
        $tahuns = SwitchHub::select('tahun')->distinct()->pluck('tahun');
        $ruangan = config('ruangan');

        return view('switchhub.laporan', compact('data', 'brands', 'kegiatans', 'tahuns', 'ruangan'));
    }
}
