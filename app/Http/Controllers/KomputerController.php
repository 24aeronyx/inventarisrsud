<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KomputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $builder = Komputer::query();

        if ($query) {
            $builder->where(function ($q) use ($query) {
                $q->where('ruangan', 'like', "%{$query}%")
                    ->orWhere('brand', 'like', "%{$query}%")
                    ->orWhere('tahun', 'like', "%{$query}%")
                    ->orWhere('os', 'like', "%{$query}%");
            });
        }

        if ($request->filled('unit')) {
            $builder->where('unit', $request->input('unit'));
        }

        $komputers = $builder
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['query' => $query, 'sort' => $sort, 'direction' => $direction, 'unit' => $request->unit]);

        $columns = [
            'ruangan' => 'Ruangan',
            'unit' => 'Unit',
            'brand' => 'Brand',
            'tahun' => 'Tahun',
            'os' => 'OS',
        ];

        return view('komputers.index', compact('komputers', 'sort', 'direction', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = $this->ruangan;
        return view('komputers.create', compact('ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan' => 'required|string|max:255',
            'unit' => 'required|in:PC Build Up,All In One,Mini PC',
            'brand' => 'nullable|string|max:255',
            'processor' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'storage_type' => 'nullable|in:SSD,HDD',
            'storage_capacity' => 'nullable|string|max:255',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|digits:4',
            'ip_address' => 'nullable|string|max:255',
        ]);

        Komputer::create($request->all());

        return redirect()->route('komputer.index')->with('success', 'Komputer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $komputer = Komputer::findOrFail($id);
        return view('komputers.show', compact('komputer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = $this->ruangan;
        $komputer = Komputer::findOrFail($id);
        return view('komputers.edit', compact('komputer', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $komputer = Komputer::findOrFail($id);

        $request->validate([
            'ruangan' => 'required|string|max:255',
            'unit' => 'required|in:PC Build Up,All In One,Mini PC',
            'brand' => 'nullable|string|max:255',
            'processor' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'storage_type' => 'nullable|in:SSD,HDD',
            'storage_capacity' => 'nullable|string|max:255',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|digits:4',
            'ip_address' => 'nullable|string|max:255',
        ]);

        $komputer->update($request->all());

        return redirect()->route('komputer.index')->with('success', 'Komputer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komputer = Komputer::findOrFail($id);
        $komputer->delete();

        return redirect()->route('komputer.index')->with('success', 'Komputer berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = Komputer::query();

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
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('komputers.laporan_pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan_komputer.pdf');
    }

    public function laporan(Request $request)
    {
        $query = Komputer::query();

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
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        $data = $query->paginate(10);

        $brands = Komputer::select('brand')->distinct()->pluck('brand');
        $kegiatans = Komputer::select('kegiatan')->distinct()->pluck('kegiatan');
        $tahuns = Komputer::select('tahun')->distinct()->pluck('tahun');
        $ruangan = config('ruangan');

        return view('komputers.laporan', compact('data', 'brands', 'kegiatans', 'tahuns', 'ruangan'));
    }
}
