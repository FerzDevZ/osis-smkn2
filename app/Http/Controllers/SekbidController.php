<?php

namespace App\Http\Controllers;

use App\Models\Sekbid;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Ukk;

class SekbidController extends Controller
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
        $sekbids = Sekbid::orderBy('display_order')->get();
        return view('sekbid.index', compact('sekbids'));
    }

    public function adminIndex()
    {
        $q = request('q');
        $sekbids = Sekbid::when($q, function($query) use ($q){
                $query->where('name','like','%'.$q.'%')->orWhere('slug','like','%'.$q.'%');
            })
            ->orderBy('display_order')->paginate(20)->withQueryString();
        return view('sekbid.admin-index', compact('sekbids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekbid.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:sekbids,slug'],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);

        $sekbid = new Sekbid($validated);
        if ($request->hasFile('image')) {
            $sekbid->image_path = $request->file('image')->store('sekbid','public');
        }
        $sekbid->save();

        return redirect()->route('sekbid.index')->with('status','Sekbid dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekbid $sekbid)
    {
        $others = Sekbid::where('id','!=',$sekbid->id)->orderBy('display_order')->limit(8)->get();
        return view('sekbid.show', compact('sekbid','others'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekbid $sekbid)
    {
        return view('sekbid.edit', compact('sekbid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sekbid $sekbid)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:sekbids,slug,'.$sekbid->id],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);

        $sekbid->fill($validated);
        if ($request->hasFile('image')) {
            $sekbid->image_path = $request->file('image')->store('sekbid','public');
        }
        $sekbid->save();

        return redirect()->route('sekbid.index')->with('status','Sekbid diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekbid $sekbid)
    {
        $sekbid->delete();
        return back()->with('status','Sekbid dihapus.');
    }

    public function landing()
    {
        $sekbids = Sekbid::orderBy('display_order')->get();
        $latestPosts = Post::where('status','published')->latest('published_at')->limit(3)->get();
        $upcoming = Event::where('is_published', true)->orderBy('start_at')->limit(4)->get();
        $galleries = Gallery::latest('album_date')->limit(6)->get();
        $organizations = Organization::orderBy('display_order')->limit(12)->get();
        $ukks = Ukk::orderBy('display_order')->limit(12)->get();
        $aspirations = \App\Models\MailMessage::where('is_public', true)
            ->where('status', 'reviewed')
            ->latest()
            ->limit(10)
            ->get();

        return view('landing', compact('sekbids','latestPosts','upcoming','galleries','organizations','ukks', 'aspirations'));
    }
}
