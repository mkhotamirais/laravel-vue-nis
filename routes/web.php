<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\FacilitycatController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfocatController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'index'])->name('home');

// Profiles
Route::inertia('/profil-ra', 'Profile/ProfileRa')->name('profile.ra');
Route::inertia('/profil-mts', 'Profile/ProfileMts')->name('profile.mts');
Route::inertia('/profil-ma', 'Profile/ProfileMa')->name('profile.ma');
Route::inertia('/profil-ponpes', 'Profile/ProfilePonpes')->name('profile.ponpes');

// Pendaftaran
Route::inertia('/pendaftaran-ra', 'Pendaftaran/PendaftaranRa')->name('pendaftaran.ma');
Route::inertia('/pendaftaran-mts', 'Pendaftaran/PendaftaranMts')->name('pendaftaran.mts');
Route::inertia('/pendaftaran-ma', 'Pendaftaran/PendaftaranMa')->name('pendaftaran.ma');
Route::inertia('/pendaftaran-ponpes', 'Pendaftaran/PendaftaranPonpes')->name('pendaftaran.ponpes');

Route::inertia('/kontak', 'Kontak')->name('kontak');

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard/Index')->middleware('verified')->name('dashboard');

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
