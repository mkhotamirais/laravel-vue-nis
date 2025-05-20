<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Facility;
use App\Models\Info;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $heroImages = Facility::latest()->take(4)->get();
        $infos = Info::with(['user:id,name', 'infocat:id,name'])
            ->whereNotNull('banner')
            ->latest()
            ->take(4)
            ->get();
        $quotes = Quote::latest()->take(3)->get();
        $facilities = Facility::latest()->take(4)->get();
        $agendas = Agenda::where(function ($query) use ($now) {
            $query->where('start_time', '>', $now) // Upcoming
                ->orWhere(function ($query) use ($now) {
                    $query->where('start_time', '<=', $now)
                        ->where('end_time', '>=', $now); // Ongoing
                });
        })
            ->orderBy('start_time', 'asc')
            ->latest()
            ->take(4)
            ->get()->map(function ($agenda) {
                $agenda->agenda_status = $agenda->status;
                return $agenda;
            });

        return inertia('Home', compact('heroImages', 'infos', 'quotes', 'facilities', 'agendas'));
    }
}
