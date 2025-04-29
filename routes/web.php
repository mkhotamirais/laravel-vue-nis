<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\FacilitycatController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\InfocatController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Agenda;
use App\Models\Facility;
use App\Models\Info;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

$now = Carbon::now();

Route::inertia('/', 'Home', [
    'heroImages' => Facility::latest()->take(4)->get(),
    'infos' => Info::with(['user:id,name', 'infocat:id,name'])
        ->whereNotNull('banner')
        ->latest()
        ->take(4)
        ->get(),
    'quotes' => Quote::latest()->take(3)->get(),
    'facilities' => Facility::latest()->take(4)->get(),
    'agendas' => Agenda::where(function ($query) use ($now) {
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
        }),
])->name('home');

// Profiles
Route::controller(SchoolProfileController::class)->group(function () {
    Route::get('/profile-ponpes', 'ponpes')->name('profile.ponpes');
    Route::get('/profile-ra', 'ra')->name('profile.ra');
    Route::get('/profile-mts', 'mts')->name('profile.mts');
    Route::get('/profile-ma', 'ma')->name('profile.ma');
});

Route::inertia('/ppdb', 'Ppdb')->name('ppdb');
Route::inertia('/kontak', 'Kontak')->name('kontak');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::middleware('password.confirm')->group(function () {
        // Admin
        Route::middleware(AdminMiddleware::class)
            ->controller(AdminController::class)
            ->group(function () {
                Route::get('/admin', 'index')->name('admin.index');
                Route::put('/admin/{user}/role', 'updateRole')->name('admin.updateRole');
            });

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('verified')->group(function () {
        // Informasi
        Route::resource('informasi', InfoController::class)
            ->parameters([
                'informasi' => 'info'
            ])->except(['index', 'show']);
        Route::resource('information-category', InfocatController::class)
            ->parameters([
                'information-category' => 'infocat',
            ])
            ->except(['create', 'show', 'edit']);

        // Fasilitas
        Route::resource('fasilitas', FacilityController::class)
            ->parameters([
                'fasilitas' => 'facility'
            ])
            ->except(['index', 'show']);
        Route::resource('facility-category', FacilitycatController::class)
            ->parameters([
                'facility-category' => 'facilitycat',
            ])
            ->except(['create', 'show', 'edit']);

        // Quotes
        Route::resource('quote', QuoteController::class)->except(['create', 'show', 'edit', 'index']);

        // Ekstrakurikuler
        Route::resource('ekstrakurikuler', ExtracurricularController::class)
            ->parameters([
                'ekstrakurikuler' => 'extracurricular'
            ])
            ->except(['index', 'show']);

        // Agenda
        Route::resource('agenda', AgendaController::class)->except(['index', 'show']);
    });
});

Route::get('/informasi', [InfoController::class, 'index'])->name('informasi');
Route::get('/informasi/{info}', [InfoController::class, 'show'])->name('informasi.show');

Route::get('/quote', [QuoteController::class, 'index'])->name('quote');

Route::get('/fasilitas', [FacilityController::class, 'index'])->name('fasilitas');

Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('ekstrakurikuler');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

require __DIR__ . '/auth.php';
