<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->paginate(2);
        $success = session('success');
        return inertia('Quotes', compact('quotes', 'success'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'content' => 'required|unique:quotes',
            'author' => 'required',
        ]);

        Auth::user()->quotes()->create($fields);

        return back()->with('success', "Quote berhasil dibuat");
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return back()->with('success', "Quote berhasil dihapus");
    }

    public function update(Request $request, Quote $quote)
    {
        $fields = $request->validate([
            'content' => 'required',
            'author' => 'required',
        ]);

        $quote->update($fields);

        return back()->with('success', "Quote berhasil di-update");
    }
}
