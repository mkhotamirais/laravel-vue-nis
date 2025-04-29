<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Facilitycat;
use App\Models\Facilityimage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with(['facilityimages', 'facilitycat:id,name'])->latest()->paginate(3);
        $success = session('success');
        return inertia('Fasilitas', compact('facilities', 'success'));
    }

    public function create()
    {
        $facilitycats = Facilitycat::orderBy('name')->get();
        return inertia('Dashboard/Facility/Create', compact('facilitycats'));
    }

    public function edit(Facility $facility)
    {
        $facility = $facility->load('facilityimages');
        $facilitycats = Facilitycat::orderBy('name')->get();
        return inertia('Dashboard/Facility/Edit', compact('facility', 'facilitycats'));
    }

    public function store(Request $request)
    {
        $fields = request()->validate([
            'name' => 'required|max:255|unique:facilities',
            'facilitycat_id' => 'required|exists:facilitycats,id',
            'caption' => 'required|string',
            'banner' => 'required|file|max:2084|mimes:jpg,jpeg,png,webp',
            'images.*' => 'file|max:1084|mimes:jpg,jpeg,png,webp'
        ]);

        if ($request->hasFile('banner')) {
            $fields['banner'] = Storage::disk('public')->put('images/facility', $request->banner);
        }

        $fields['slug'] = Str::slug($request->name);

        $facility = Auth::user()->facilities()->create($fields);

        // Simpan gambar-gambar ke storage dan database
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/facility', 'public');
                $facility->facilityimages()->create(['image' => $path]);
            }
        }

        return redirect()->route('fasilitas')->with('success', "Facility '$request->name' berhasil dibuat");
    }

    public function destroy(Facility $facility)
    {
        foreach ($facility->facilityimages as $image) {
            $filePath = $image->image;
            if (Storage::disk('public')->exists($filePath)) {
                // dump('File exists: ' . $filePath);
                Storage::disk('public')->delete($filePath);
                // dump('File deleted: ' . $filePath);
            } else {
                // dump('File not found: ' . $filePath);
            }
            $image->delete(); // Hapus data dari database
        }

        if ($facility->banner) {
            Storage::disk('public')->delete($facility->banner);
        }

        $facility->delete();

        return back()->with('success', 'Facility deleted successfully');
    }

    public function update(Request $request, Facility $facility)
    {
        $fields = request()->validate([
            'name' => 'required|max:255|unique:facilities,name,' . $facility->id,
            'facilitycat_id' => 'required|exists:facilitycats,id',
            'caption' => 'required|string',
            'banner' => 'nullable|file|max:2084|mimes:jpg,jpeg,png,webp',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:facilityimages,id',
            'images.*' => 'file|max:1084|mimes:jpg,jpeg,png,webp'
        ]);

        $fields['slug'] = Str::slug($request->name);

        if ($request->hasFile('banner')) {
            if ($facility->banner) {
                Storage::disk('public')->delete($facility->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('images/facility', $request->banner);
        } else {
            $fields['banner'] = $facility->banner;
        }

        $facility->update($fields);

        // Hapus gambar yang dipilih
        if ($request->has('delete_images')) {
            $imagesToDelete = Facilityimage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $image) {
                // Hapus file fisik
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
                // Hapus data dari database
                $image->delete();
            }
        }

        // Simpan gambar-gambar ke storage dan database
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/facility', 'public');
                $facility->facilityimages()->create(['image' => $path]);
            }
        }

        return redirect()->route('fasilitas')->with('success', "Facility '$request->name' berhasil dibuat");
    }
}
