<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::withCount('attendances')->latest()->get();
        return view('meetings.index', compact('meetings'));
    }

    public function attend(Request $request, Meeting $meeting)
    {
        $request->validate([
            'passcode' => 'required|string',
            'member_name' => 'required|string|max:150',
            'position' => 'nullable|string|max:100',
        ]);

        if ($request->passcode !== $meeting->passcode) {
            return back()->withErrors(['passcode' => 'PIN / Kode Passcode Rapat Salah!']);
        }

        MeetingAttendance::create([
            'meeting_id' => $meeting->id,
            'user_id' => auth()->id(),
            'member_name' => $request->member_name,
            'position' => $request->position,
            'attended_at' => now(),
        ]);

        return back()->with('status', 'Kehadiran rapat berhasil dicatat!');
    }
}
