<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;
        $extracurriculars = Extracurricular::with('user:id,name,role')
            ->filter(request(['category']))
            ->latest()
            ->paginate(6);
        $success = session('success');
        return inertia('Ekstrakurikuler', compact('success', 'extracurriculars', 'category'));
    }

    public function create()
    {
        return inertia('Dashboard/Extracurricular/Create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:extracurriculars',
            'mentor' => 'nullable|string',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string',
            'banner' => 'nullable|file|max:2084|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('banner')) {
            $fields['banner'] = Storage::disk('public')->put('images/information', $request->banner);
        }

        $request->user()->extracurriculars()->create($fields);

        return redirect()->route('ekstrakurikuler')->with('success', "Ekstrakurikuler '$request->title' berhasil dibuat");
    }

    public function edit(Extracurricular $extracurricular)
    {
        return inertia('Dashboard/Extracurricular/Edit', compact('extracurricular'));
    }

    public function update(Extracurricular $extracurricular, Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:extracurriculars,name,' . $extracurricular->id,
            'mentor' => 'nullable|string',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string',
            'banner' => 'nullable|file|max:2084|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('banner')) {
            if ($extracurricular->banner) {
                Storage::disk('public')->delete($extracurricular->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('images/extracurricular', $request->banner);
        } else {
            $fields['banner'] = $extracurricular->banner;
        }

        $extracurricular->update($fields);

        return redirect()->route('ekstrakurikuler')->with('success', "Ekstrakurikuler '$request->title' berhasil update");
    }

    public function destroy(Extracurricular $extracurricular)
    {
        if ($extracurricular->banner) {
            Storage::disk('public')->delete($extracurricular->banner);
        }
        $extracurricular->delete();
        return back()->with('success', "'$extracurricular->name' berhasil dihapus");
    }
}
