<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
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
        $range = request('range');
        $query = Event::where('is_published', true);
        if ($range === 'week') {
            $query->whereBetween('start_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($range === 'month') {
            $query->whereBetween('start_at', [now()->startOfMonth(), now()->endOfMonth()]);
        } elseif ($range === 'upcoming') {
            $query->where('start_at', '>=', now());
        } elseif ($range === 'past') {
            $query->where('start_at', '<', now());
        }
        $events = $query->orderBy('start_at','desc')->paginate(12)->withQueryString();
        return view('events.index', compact('events'));
    }

    public function adminIndex()
    {
        $q = request('q'); $status = request('status');
        $events = Event::when($q, function($query) use ($q){
                $query->where('title','like','%'.$q.'%')->orWhere('location','like','%'.$q.'%');
            })
            ->when($status !== null && in_array($status, ['0','1'], true), function($query) use ($status){ $query->where('is_published', (bool)intval($status)); })
            ->orderBy('start_at','desc')->paginate(20)->withQueryString();
        return view('events.admin-index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:220','unique:events,slug'],
            'description' => ['nullable','string'],
            'start_at' => ['nullable','date'],
            'end_at' => ['nullable','date','after_or_equal:start_at'],
            'location' => ['nullable','string','max:200'],
            'is_published' => ['nullable','boolean'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $event = new Event($validated);
        if (empty($event->slug)) { $event->slug = str()->slug($event->title).'-'.str()->random(4); }
        if ($request->hasFile('cover')) { $event->cover_path = $request->file('cover')->store('events','public'); }
        $event->save();
        return redirect()->route('event.index')->with('status','Event dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $related = Event::where('is_published', true)
            ->where('id', '!=', $event->id)
            ->orderBy('start_at', 'desc')
            ->limit(4)
            ->get();
        return view('events.show', compact('event','related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:200'],
            'slug' => ['required','string','max:220','unique:events,slug,'.$event->id],
            'description' => ['nullable','string'],
            'start_at' => ['nullable','date'],
            'end_at' => ['nullable','date','after_or_equal:start_at'],
            'location' => ['nullable','string','max:200'],
            'is_published' => ['nullable','boolean'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $event->fill($validated);
        if ($request->hasFile('cover')) { $event->cover_path = $request->file('cover')->store('events','public'); }
        $event->save();
        return redirect()->route('event.index')->with('status','Event diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('status','Event dihapus.');
    }

    public function togglePublish(Event $event)
    {
        $event->is_published = !$event->is_published;
        $event->save();
        return back()->with('status','Status event diperbarui.');
    }
}
