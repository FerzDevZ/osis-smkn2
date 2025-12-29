<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailMessageController;
use App\Http\Controllers\SekbidController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UkkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SekbidController::class, 'landing'])->name('home');
Route::view('/tentang', 'about')->name('about');

// Public routes
Route::resource('berita', PostController::class)->only(['index','show']);
Route::get('kotak-surat', [MailMessageController::class, 'create'])->name('kotak.create');
Route::post('kotak-surat', [MailMessageController::class, 'store'])->name('kotak.store');
Route::get('sekbid', [SekbidController::class, 'index'])->name('sekbid.index');
Route::get('sekbid/{sekbid:slug}', [SekbidController::class, 'show'])->name('sekbid.show');
Route::get('event', [EventController::class, 'index'])->name('event.index');
Route::get('event/{event:slug}', [EventController::class, 'show'])->name('event.show');
Route::get('galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('galeri/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('organisasi', [OrganizationController::class, 'index'])->name('organization.index');
Route::get('organisasi/{organization:slug}', [OrganizationController::class, 'show'])->name('organization.show');
Route::get('ukk', [UkkController::class, 'index'])->name('ukk.index');
Route::get('ukk/{ukk:slug}', [UkkController::class, 'show'])->name('ukk.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin CRUD
    Route::resource('admin/berita', PostController::class)->except(['index','show'])->names('admin.berita');
    Route::resource('admin/sekbid', SekbidController::class)->except(['show'])->names('admin.sekbid');
    Route::resource('admin/event', EventController::class)->except(['show'])->names('admin.event');
    Route::resource('admin/galeri', GalleryController::class)->except(['show'])->names('admin.gallery');
    Route::resource('admin/organisasi', OrganizationController::class)->except(['show'])->names('admin.organization');
    Route::resource('admin/ukk', UkkController::class)->except(['show'])->names('admin.ukk');
    Route::get('admin/berita', [PostController::class, 'adminIndex'])->name('admin.berita.index');
    Route::get('admin/sekbid', [SekbidController::class, 'adminIndex'])->name('admin.sekbid.index');
    Route::get('admin/event', [EventController::class, 'adminIndex'])->name('admin.event.index');
    Route::get('admin/galeri', [GalleryController::class, 'adminIndex'])->name('admin.gallery.index');
    Route::get('admin/organisasi', [OrganizationController::class, 'adminIndex'])->name('admin.organization.index');
    Route::get('admin/ukk', [UkkController::class, 'adminIndex'])->name('admin.ukk.index');

    // Quick publish/unpublish
    Route::patch('admin/berita/{post}/toggle', [PostController::class, 'togglePublish'])->name('admin.berita.toggle');
    Route::patch('admin/event/{event}/toggle', [EventController::class, 'togglePublish'])->name('admin.event.toggle');
    // Gallery photos
    Route::post('admin/galeri/{gallery}/photos', [GalleryController::class, 'storePhotos'])->name('admin.gallery.photos.store');
    Route::delete('admin/galeri/{gallery}/photos/{photo}', [GalleryController::class, 'destroyPhoto'])->name('admin.gallery.photos.destroy');
    Route::get('admin/kotak-surat', [MailMessageController::class, 'index'])->name('kotak.index');
    Route::patch('admin/kotak-surat/{mailMessage}', [MailMessageController::class, 'update'])->name('kotak.update');
    Route::delete('admin/kotak-surat/{mailMessage}', [MailMessageController::class, 'destroy'])->name('kotak.destroy');
});

require __DIR__.'/auth.php';

// Sitemap
Route::get('/sitemap.xml', function() {
    $posts = \App\Models\Post::where('status','published')->latest('published_at')->get(['slug','updated_at']);
    $events = \App\Models\Event::where('is_published',true)->latest('updated_at')->get(['slug','updated_at']);
    $sekbids = \App\Models\Sekbid::latest('updated_at')->get(['slug','updated_at']);
    $galleries = \App\Models\Gallery::latest('updated_at')->get(['id','updated_at']);
    return response()->view('sitemap', compact('posts','events','sekbids','galleries'))
        ->header('Content-Type', 'application/xml');
});
