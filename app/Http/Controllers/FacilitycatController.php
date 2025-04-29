<?php

namespace App\Http\Controllers;

use App\Models\Facilitycat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilitycatController extends Controller
{
    public function index(Request $request)
    {
        $facilitycats = Facilitycat::with('user:id,name')
            ->filter(request(['search']))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $success = session('success');

        $searchTerm = $request->search;
        return inertia('Dashboard/Facility/Facilitycat', compact('facilitycats', 'success', 'searchTerm'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:facilitycats',
        ]);

        $slug = Str::slug($request->name);

        Auth::user()->facilitycats()->create([...$fields, 'slug' => $slug]);

        return back()->with('success', "Facility Category '$request->name' berhasil dibuat");
    }

    public function destroy(Facilitycat $facilitycat)
    {
        $facilitycat->delete();
        return back()->with('success', "$facilitycat->name berhasil dihapus");
    }

    public function update(Request $request, Facilitycat $facilitycat)
    {
        $fields = $request->validate([
            'name' => "required|max:255|unique:facilitycats,name,$facilitycat->id"
        ]);

        $slug = Str::slug($request->name);

        $facilitycat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', "Facility Category '$request->name' berhasil di-update");
    }
}
