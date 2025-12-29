<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if ($request->is('admin/*') && !optional($request->user())->is_admin) {
                abort(403);
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('album_date', 'desc')->paginate(18);
        return view('gallery.index', compact('galleries'));
    }

    public function adminIndex()
    {
        $q = request('q');
        $galleries = Gallery::when($q, function($query) use ($q){
                $query->where('title','like','%'.$q.'%');
            })
            ->orderBy('album_date', 'desc')->paginate(20)->withQueryString();
        return view('gallery.admin-index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'album_date' => ['nullable','date'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $gallery = new Gallery($validated);
        if ($request->hasFile('cover')) {
            $gallery->cover_path = $request->file('cover')->store('galleries','public');
        }
        $gallery->save();

        return redirect()->route('admin.gallery.edit', $gallery)->with('status','Album dibuat. Silakan tambahkan foto.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('photos');
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $gallery->load('photos');
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'album_date' => ['nullable','date'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $gallery->fill($validated);
        if ($request->hasFile('cover')) {
            $gallery->cover_path = $request->file('cover')->store('galleries','public');
        }
        $gallery->save();

        return back()->with('status','Album diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('status', 'Album dihapus.');
    }

    public function storePhotos(Request $request, Gallery $gallery)
    {
        $request->validate([
            'photos.*' => ['required','image','max:6144'],
            'captions' => ['array'],
        ]);

        $files = $request->file('photos', []);
        foreach ($files as $idx => $file) {
            $path = $file->store('gallery_photos','public');
            GalleryPhoto::create([
                'gallery_id' => $gallery->id,
                'image_path' => $path,
                'caption' => $request->input("captions.$idx"),
                'display_order' => 0,
            ]);
        }
        return back()->with('status','Foto ditambahkan.');
    }

    public function destroyPhoto(Gallery $gallery, GalleryPhoto $photo)
    {
        if ($photo->gallery_id !== $gallery->id) { abort(404); }
        $photo->delete();
        return back()->with('status','Foto dihapus.');
    }
}
