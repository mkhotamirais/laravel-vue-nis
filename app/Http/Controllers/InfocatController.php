<?php

namespace App\Http\Controllers;

use App\Models\Infocat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfocatController extends Controller
{
    public function index(Request $request)
    {
        $infocats = Infocat::with('user:id,name,role')
            ->filter(request(['search']))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $success = session('success');

        $searchTerm = $request->search;
        return inertia('Dashboard/Info/Infocat', compact('infocats', 'success', 'searchTerm'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:infocats',
        ]);

        $slug = Str::slug($request->name);

        Auth::user()->infocats()->create([...$fields, 'slug' => $slug]);

        return back()->with('success', "Information Category '$request->name' berhasil dibuat");
    }

    public function destroy(Infocat $infocat)
    {
        $infocat->delete();
        return back()->with('success', "$infocat->name berhasil dihapus");
    }

    public function update(Request $request, Infocat $infocat)
    {
        $fields = $request->validate([
            'name' => "required|max:255|unique:infocats,name,$infocat->id"
        ]);

        $slug = Str::slug($request->name);

        $infocat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', "Information Category '$request->name' berhasil di-update");
    }
}
