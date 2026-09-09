<?php

use App\Http\Controllers\Admin\ContactSubmissionController as AdminContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SitePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePageController::class, 'home'])->name('home');
Route::get('/producto', [SitePageController::class, 'product'])->name('producto');
Route::get('/nosotros', [SitePageController::class, 'about'])->name('nosotros');
Route::get('/contacto', [SitePageController::class, 'contact'])->name('contacto');
Route::post('/contacto', [ContactSubmissionController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contacto.store');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/dashboard', '/admin')->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::get('/contenido/{page}/editar', [AdminPageController::class, 'edit'])->name('pages.edit');
    Route::put('/contenido/{page}', [AdminPageController::class, 'update'])->name('pages.update');
    Route::get('/multimedia', [AdminMediaController::class, 'index'])->name('media.index');
    Route::post('/multimedia', [AdminMediaController::class, 'store'])->name('media.store');
    Route::get('/solicitudes', [AdminContactSubmissionController::class, 'index'])->name('contacts.index');
    Route::get('/solicitudes/{contactSubmission}', [AdminContactSubmissionController::class, 'show'])->name('contacts.show');
    Route::patch('/solicitudes/{contactSubmission}', [AdminContactSubmissionController::class, 'update'])->name('contacts.update');
    Route::get('/configuracion', [AdminSiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/configuracion', [AdminSiteSettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/settings.php';
