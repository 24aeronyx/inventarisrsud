<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Printer;
use Barryvdh\DomPDF\Facade\Pdf;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $printers = Printer::where(function ($q) use ($query) {
            $q->where('ruangan', 'like', "%{$query}%")
                ->orWhere('brand', 'like', "%{$query}%")
                ->orWhere('jenis', 'like', "%{$query}%")
                ->orWhere('tahun', 'like', "%{$query}%");
        })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends([
                'query' => $query,
                'sort' => $sort,
                'direction' => $direction
            ]);
        $columns = [
            'ruangan' => 'Ruangan',
            'brand' => 'Brand',
            'jenis' => 'Jenis',
            'tahun' => 'Tahun',
        ];
        return view('printers.index', compact('printers', 'columns', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = $this->ruangan;
        return view('printers.create', compact('ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        Printer::create($request->all());

        return redirect()->route('printer.index')->with('success', 'Printer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruangan = $this->ruangan;
        $printer = Printer::findOrFail($id);
        return view('printers.show', compact('printer', 'ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = $this->ruangan;
        $printer = Printer::findOrFail($id);
        return view('printers.edit', compact('printer', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $printer = Printer::findOrFail($id);

        $request->validate([
            'ruangan' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|digits:4',
        ]);

        $printer->update($request->all());

        return redirect()->route('printer.index')->with('success', 'Printer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $printer = Printer::findOrFail($id);
        $printer->delete();

        return redirect()->route('printer.index')->with('success', 'Printer berhasil dihapus.');
    }

    public function printLaporan(Request $request)
    {
        $query = Printer::query();

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
        if ($request->filled('jenis')) {
            $query->where('jenis', 'like', "%{$request->jenis}%");
        }

        $data = $query->get();

        $pdf = Pdf::loadView('printers.laporan_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_printer.pdf');
    }

    public function laporan(Request $request)
    {
        $query = Printer::query();

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
        if ($request->filled('jenis')) {
            $query->where('jenis', 'like', "%{$request->jenis}%");
        }

        $data = $query->paginate(10);
        $brands = Printer::select('brand')->distinct()->pluck('brand');
        $kegiatans = Printer::select('kegiatan')->distinct()->pluck('kegiatan');
        $tahuns = Printer::select('tahun')->distinct()->pluck('tahun');
        $jenis = Printer::select('jenis')->distinct()->pluck('jenis');
        $ruangan = config('ruangan');

        return view('printers.laporan', compact('data', 'brands', 'kegiatans', 'tahuns', 'ruangan', 'jenis'));
    }
}
