<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = EventTicket::with('event')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $events = Event::where('is_published', true)->latest()->get();

        return view('tickets.index', compact('tickets', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'holder_name' => 'required|string|max:150',
            'holder_nisn' => 'nullable|string|max:20'
        ]);

        $code = 'TKT-' . strtoupper(Str::random(8));

        $ticket = EventTicket::create([
            'event_id' => $request->event_id,
            'user_id' => auth()->id(),
            'ticket_code' => $code,
            'holder_name' => $request->holder_name,
            'holder_nisn' => $request->holder_nisn,
            'status' => 'valid',
        ]);

        return back()->with('status', "E-Pass Tiket Berhasil Diterbitkan! Kode: {$code}");
    }
}
