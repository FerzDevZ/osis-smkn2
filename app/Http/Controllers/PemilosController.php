<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilosController extends Controller
{
    public function index()
    {
        $candidates = Candidate::orderBy('order')->get();
        $hasVoted = Vote::where('user_id', Auth::id())->exists();
        
        return view('pemilos.index', compact('candidates', 'hasVoted'));
    }

    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        if (Vote::where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'Anda sudah memberikan suara!');
        }

        Vote::create([
            'user_id' => Auth::id(),
            'candidate_id' => $request->candidate_id,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('pemilos.index')->with('status', 'Terima kasih! Suara Anda telah direkam.');
    }

    public function results()
    {
        $candidates = Candidate::withCount('votes')->orderBy('votes_count', 'desc')->get();
        return view('pemilos.results', compact('candidates'));
    }
}
