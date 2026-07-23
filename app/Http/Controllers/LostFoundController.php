<?php

namespace App\Http\Controllers;

use App\Models\LostFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LostFoundController extends Controller
{
    public function index()
    {
        $items = LostFound::with('reporter')->latest()->paginate(20);
        return view('lost-found.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:lost,found',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lost-found', 'public');
        }

        LostFound::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'image_path' => $imagePath,
            'reporter_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return back()->with('status', 'Laporan berhasil dikirim!');
    }

    public function resolve(LostFound $item)
    {
        // Only reporter or admin can resolve
        if (Auth::id() !== $item->reporter_id && !Auth::user()->hasRole('Super Admin')) {
            abort(403);
        }

        $item->update(['status' => 'resolved']);
        return back()->with('status', 'Status laporan diperbarui!');
    }
}
