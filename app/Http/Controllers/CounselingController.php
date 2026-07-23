<?php

namespace App\Http\Controllers;

use App\Models\CounselingMessage;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    public function create()
    {
        return view('counseling.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10',
            'contact_phone' => 'nullable|string|max:25',
            'is_anonymous' => 'nullable|boolean'
        ]);

        CounselingMessage::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'contact_phone' => $request->contact_phone,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'status' => 'pending',
        ]);

        return back()->with('status', 'Pesan konseling/aduan privat berhasil dikirim. Tim Pembina & BK akan segera merespon.');
    }
}
