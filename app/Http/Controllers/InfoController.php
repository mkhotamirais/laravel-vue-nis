<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Infocat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        $infos = Info::with(['user:id,name', 'infocat:id,name'])
            ->filter(request(['search', 'category', 'tag']))
            ->latest()
            ->paginate(4)
            ->withQueryString();

        $infocats = Infocat::orderBy('name')->get();

        $infocatsMa = Infocat::whereHas('user', callback: function (Builder $query) {
            $query->where('role', '=', 'editor_ma');
        })->withCount('infos')->orderBy('name')->get();

        $infocatsMts = Infocat::whereHas('user', callback: function (Builder $query) {
            $query->where('role', 'editor_mts');
        })->withCount('infos')->orderBy('name')->get();

        $infocatsRa = Infocat::whereHas('user', callback: function (Builder $query) {
            $query->where('role', 'editor_ra');
        })->withCount('infos')->orderBy('name')->get();

        $infocatsPonpes = Infocat::whereHas('user', callback: function (Builder $query) {
            $query->where('role', 'editor_ponpes');
        })->withCount('infos')->orderBy('name')->get();

        $success = session('success');

        return inertia('Informasi', compact('infos', 'infocats', 'infocatsMa', 'infocatsMts', 'infocatsRa', 'infocatsPonpes', 'success'));
    }

    public function show(Info $info)
    {
        $latestInfos = Info::with(['user:id,name', 'infocat:id,name'])
            ->latest()
            ->take(6)
            ->get();

        return inertia('InformasiShow', compact('info', 'latestInfos'));
    }

    public function create()
    {
        $infocats = Infocat::with('user:id,name,role')->orderBy('name')->get();
        return inertia('Dashboard/Info/Create', compact('infocats'));
    }

    public function edit(Info $info)
    {
        $infocats = Infocat::with('user:id,name,role')->orderBy('name')->get();
        return inertia('Dashboard/Info/Edit', compact('info', 'infocats'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'infocat_id' => 'required|exists:infocats,id',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'banner' => 'nullable|file|max:2084|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('banner')) {
            $fields['banner'] = Storage::disk('public')->put('images/information', $request->banner);
        }

        $fields['tags'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->tags)))));
        $fields['slug'] = Str::slug($request->title);

        Auth::user()->infos()->create($fields);

        return redirect()->route('informasi')->with('success', "Information '$request->title' berhasil dibuat");
    }

    public function destroy(Info $info)
    {
        if ($info->banner) {
            Storage::disk('public')->delete($info->banner);
        }
        $info->delete();
        return back()->with('success', "'$info->title' berhasil dihapus");
    }

    public function update(Info $info, Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255|unique:infos,title,' . $info->id,
            'infocat_id' => 'required|exists:infocats,id',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'banner' => 'nullable|file|max:2084|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('banner')) {
            if ($info->banner) {
                Storage::disk('public')->delete($info->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('images/information', $request->banner);
        } else {
            $fields['banner'] = $info->banner;
        }

        $fields['tags'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->tags)))));
        $fields['slug'] = Str::slug($request->title);

        $info->update($fields);

        return redirect()->route('informasi')->with('success', "Information '$request->title' berhasil diupdate");
    }
}
