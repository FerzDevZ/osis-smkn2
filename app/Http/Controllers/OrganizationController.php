<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $items = Organization::orderBy('display_order')->paginate(12);
        return view('organization.index', compact('items'));
    }

    public function show(Organization $organization)
    {
        return view('organization.show', ['item' => $organization]);
    }

    public function adminIndex()
    {
        $q = request('q');
        $items = Organization::when($q, fn($qr)=>$qr->where('name','like','%'.$q.'%'))
            ->orderBy('display_order')->paginate(20)->withQueryString();
        return view('organization.admin-index', compact('items'));
    }

    public function create() { return view('organization.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:organizations,slug'],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'contact' => ['nullable','string','max:150'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);
        $org = new Organization($validated);
        if ($request->hasFile('image')) { $org->image_path = $request->file('image')->store('organization','public'); }
        $org->save();
        return redirect()->route('admin.organization.index')->with('status','Organisasi dibuat.');
    }

    public function edit(Organization $organization) { return view('organization.edit', ['item' => $organization]); }

    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'slug' => ['required','string','max:160','unique:organizations,slug,'.$organization->id],
            'description' => ['nullable','string'],
            'instagram_url' => ['nullable','url'],
            'contact' => ['nullable','string','max:150'],
            'display_order' => ['nullable','integer','min:0'],
            'image' => ['nullable','image','max:4096'],
        ]);
        $organization->fill($validated);
        if ($request->hasFile('image')) { $organization->image_path = $request->file('image')->store('organization','public'); }
        $organization->save();
        return redirect()->route('admin.organization.index')->with('status','Organisasi diperbarui.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return back()->with('status','Organisasi dihapus.');
    }
}


