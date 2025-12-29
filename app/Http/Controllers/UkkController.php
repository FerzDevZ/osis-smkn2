<?php

namespace App\Http\Controllers;

use App\Models\Ukk;
use Illuminate\Http\Request;

class UkkController extends Controller
{
    public function index()
    {
        $items = Ukk::orderBy('display_order')->paginate(12);
        return view('ukk.index', compact('items'));
    }

    public function show(Ukk $ukk)
    {
        return view('ukk.show', ['item' => $ukk]);
    }

    public function adminIndex()
    {
        $q = request('q');
        $items = Ukk::when($q, fn($qr)=>$qr->where('name','like','%'.$q.'%'))
            ->orderBy('display_order')->paginate(20)->withQueryString();
        return view('ukk.admin-index', compact('items'));
    }

    public function create() { return view('ukk.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:ukks,slug'],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'contact' => ['nullable','string','max:150'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);
        $model = new Ukk($validated);
        if ($request->hasFile('image')) { $model->image_path = $request->file('image')->store('ukk','public'); }
        $model->save();
        return redirect()->route('admin.ukk.index')->with('status','UKK dibuat.');
    }

    public function edit(Ukk $ukk) { return view('ukk.edit', ['item' => $ukk]); }

    public function update(Request $request, Ukk $ukk)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:ukks,slug,'.$ukk->id],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'contact' => ['nullable','string','max:150'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);
        $ukk->fill($validated);
        if ($request->hasFile('image')) { $ukk->image_path = $request->file('image')->store('ukk','public'); }
        $ukk->save();
        return redirect()->route('admin.ukk.index')->with('status','UKK diperbarui.');
    }

    public function destroy(Ukk $ukk)
    {
        $ukk->delete();
        return back()->with('status','UKK dihapus.');
    }
}


