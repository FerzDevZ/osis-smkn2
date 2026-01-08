<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('display_order')->get();
        return view('members.index', compact('members'));
    }

    public function adminIndex()
    {
        $members = Member::orderBy('display_order')->paginate(20);
        return view('members.admin-index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'instagram_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('members', 'public');
        }

        Member::create($validated);

        return redirect()->route('admin.members.index')->with('status', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'instagram_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')->with('status', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }
        $member->delete();

        return back()->with('status', 'Anggota berhasil dihapus.');
    }
}
