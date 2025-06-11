<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Infocat;
use App\Models\Infoimage;
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
            ->paginate(8)
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

        $additionalImages = $info->infoimages()->pluck('image')->toArray();

        $infoImages = array_filter(array_merge([$info->banner], $additionalImages));

        return inertia('InformasiShow', compact('info', 'latestInfos', 'infoImages'));
    }

    public function create()
    {
        $infocats = Infocat::with('user:id,name,role')->orderBy('name')->get();
        return inertia('Dashboard/Info/Create', compact('infocats'));
    }

    public function edit(Info $info)
    {
        $info = $info->load('infoimages');
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
            'banner' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,webp',
            'images.*' => 'file|max:2048|mimes:jpg,jpeg,png,webp'
        ]);

        if ($request->hasFile('banner')) {
            $fields['banner'] = Storage::disk('public')->put('images/information', $request->banner);
        }

        $fields['tags'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->tags)))));
        $fields['slug'] = Str::slug($request->title);

        $info = $request->user()->infos()->create($fields);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/information', 'public');
                $info->infoimages()->create(['image' => $path]);
            }
        }

        return redirect()->route('informasi')->with('success', "Information '$request->title' berhasil dibuat");
    }

    public function destroy(Info $info)
    {
        foreach ($info->infoimages as $image) {
            $filePath = $image->image;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $image->delete();
        }
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
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:infoimages,id',
            'images.*' => 'file|max:1084|mimes:jpg,jpeg,png,webp'
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

        // Hapus gambar yang dipilih
        if ($request->has('delete_images')) {
            $imagesToDelete = Infoimage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $image) {
                // Hapus file fisik
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
                $image->delete();
            }
        }

        // Simpan gambar-gambar ke storage dan database
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/information', 'public');
                $info->infoimages()->create(['image' => $path]);
            }
        }

        return redirect()->route('informasi')->with('success', "Information '$request->title' berhasil diupdate");
    }
}
