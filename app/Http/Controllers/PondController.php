<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use Illuminate\Http\Request;

class PondController extends Controller
{
    public function index(Request $request)
    {
        $query = Pond::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        $ponds = $query->withCount('waterLogs')->get();
        return view('ponds.index', compact('ponds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama kolam wajib diisi.',
        ]);

        Pond::create($request->all());

        return redirect()->back()->with('success', 'Kolam berhasil ditambahkan.');
    }

    public function update(Request $request, Pond $pond)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama kolam wajib diisi.',
        ]);

        $pond->update($request->all());

        return redirect()->back()->with('success', 'Kolam berhasil diperbarui.');
    }

    public function destroy(Pond $pond)
    {
        $pond->delete();
        return redirect()->back()->with('success', 'Kolam berhasil dihapus.');
    }
}
