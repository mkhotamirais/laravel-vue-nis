<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        // $agendas = Agenda::with('user')->latest()->get();
        $agendas = Agenda::latest()->get()->map(function ($agenda) {
            $agenda->agenda_status = $agenda->status; // Memastikan status ada di setiap agenda
            return $agenda;
        });
        $success = session('success');
        return inertia('Agenda', compact('agendas', 'success'));
    }

    public function create()
    {
        return inertia('Dashboard/Agenda/Create');
    }

    public function edit(Agenda $agenda)
    {
        return inertia('Dashboard/Agenda/Edit', compact('agenda'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required|string',
        ]);

        $request->user()->agendas()->create($fields);

        return redirect()->route('agenda')->with('success', "Agenda '$request->title' berhasil dibuat");
    }

    public function update(Request $request, Agenda $agenda)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required|string',
        ]);

        $agenda->update($fields);

        return redirect()->route('agenda')->with('success', "Agenda '$request->title' berhasil update");
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', "'$agenda->title' berhasil dihapus");
    }
}
