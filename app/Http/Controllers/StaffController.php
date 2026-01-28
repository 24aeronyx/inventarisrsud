<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $staffs = User::where('role', 'staff')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('username', 'like', '%' . $query . '%');
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['query' => $query, 'sort' => $sort, 'direction' => $direction]);

        $columns = [
            'role' => 'Role',
            'name' => 'Nama',
            'username' => 'Username',
        ];

        return view('staff.index', compact('staffs', 'columns', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = User::findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = User::findOrFail($id);
        if ($staff->role !== 'staff') {
            abort(403, 'Hanya data staff yang dapat diedit.');
        }
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = User::findOrFail($id);
        if ($staff->role !== 'staff') {
            abort(403, 'Hanya data staff yang dapat diedit.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $staff->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $staff->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $staff->password,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = User::findOrFail($id);
        if ($staff->role !== 'staff') {
            abort(403, 'Hanya data staff yang dapat dihapus.');
        }

        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }
}
