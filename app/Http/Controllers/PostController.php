<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
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
        $posts = Post::where('status','published')->latest('published_at')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function adminIndex()
    {
        $q = request('q'); $status = request('status');
        $posts = Post::when($q, function($query) use ($q){
                $query->where('title','like','%'.$q.'%')->orWhere('excerpt','like','%'.$q.'%');
            })
            ->when(in_array($status, ['draft','published']), function($query) use ($status){ $query->where('status', $status); })
            ->latest('created_at')->paginate(20)->withQueryString();
        return view('posts.admin-index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:200'],
            'excerpt' => ['nullable','string','max:300'],
            'body' => ['required','string'],
            'status' => ['required','in:draft,published'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $post = new Post($validated);
        $post->slug = Str::slug($validated['title']).'-'.Str::random(4);
        $post->author_id = $request->user()->id;
        if ($request->hasFile('cover')) {
            $post->cover_path = $request->file('cover')->store('posts','public');
        }
        if ($post->status === 'published') {
            $post->published_at = now();
        }
        $post->save();

        return redirect()->route('admin/berita.index')->with('status','Berita dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $related = Post::where('status','published')
            ->where('id','!=',$post->id)
            ->latest('published_at')
            ->limit(4)
            ->get();
        return view('posts.show', ['post' => $post, 'related' => $related]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:200'],
            'excerpt' => ['nullable','string','max:300'],
            'body' => ['required','string'],
            'status' => ['required','in:draft,published'],
            'cover' => ['nullable','image','max:4096'],
        ]);

        $post->fill($validated);
        if ($request->hasFile('cover')) {
            $post->cover_path = $request->file('cover')->store('posts','public');
        }
        $post->published_at = $validated['status'] === 'published' ? ($post->published_at ?? now()) : null;
        $post->save();

        return redirect()->route('admin/berita.index')->with('status','Berita diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('status','Berita dihapus.');
    }

    public function togglePublish(Post $post)
    {
        if ($post->status === 'published') {
            $post->status = 'draft';
            $post->published_at = null;
        } else {
            $post->status = 'published';
            $post->published_at = $post->published_at ?? now();
        }
        $post->save();
        return back()->with('status', 'Status berita diperbarui.');
    }
}
