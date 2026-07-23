<?php

namespace App\Http\Controllers;

use App\Models\MenfessMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenfessController extends Controller
{
    public function index()
    {
        $messages = MenfessMessage::where('is_approved', true)->latest()->paginate(20);
        return view('menfess.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        MenfessMessage::create([
            'content' => $request->content,
            'is_approved' => false, // Needs moderation
            'sender_id' => Auth::id(),
        ]);

        return back()->with('status', 'Pesan Menfess terkirim! Menunggu moderasi admin.');
    }

    public function adminIndex()
    {
        $messages = MenfessMessage::latest()->paginate(50);
        return view('menfess.admin-index', compact('messages'));
    }

    public function toggleApproval(MenfessMessage $menfess)
    {
        $menfess->update(['is_approved' => !$menfess->is_approved]);
        return back()->with('status', 'Status Menfess diperbarui.');
    }

    public function destroy(MenfessMessage $menfess)
    {
        $menfess->delete();
        return back()->with('status', 'Pesan Menfess dihapus.');
    }
}
