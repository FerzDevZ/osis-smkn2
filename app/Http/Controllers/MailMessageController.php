<?php

namespace App\Http\Controllers;

use App\Models\MailMessage;
use Illuminate\Http\Request;

class MailMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = MailMessage::latest()->paginate(15);
        return view('mailbox.index', compact('messages'));
    }

    public function publicIndex()
    {
        $aspirations = MailMessage::where('is_public', true)
            ->where('status', 'reviewed')
            ->latest()
            ->paginate(12);
        return view('mailbox.public-index', compact('aspirations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mailbox.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'is_anonymous' => ['nullable','boolean'],
            'student_name' => ['nullable','string','max:120'],
            'class_name' => ['nullable','string','max:60'],
            'contact' => ['nullable','string','max:120'],
            'category' => ['required','in:saran,keluhan,umum'],
            'message' => ['required','string','max:5000'],
            'is_public' => ['nullable','boolean'],
        ]);

        if (!($validated['is_anonymous'] ?? false)) {
            if (empty($validated['student_name'])) {
                return back()->withErrors(['student_name' => 'Nama wajib bila tidak anonim'])->withInput();
            }
        } else {
            $validated['student_name'] = null;
            $validated['class_name'] = null;
            $validated['contact'] = null;
        }

        MailMessage::create($validated);
        return redirect()->route('kotak.create')->with('status','Pesan terkirim. Terima kasih!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MailMessage $mailMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailMessage $mailMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MailMessage $mailMessage)
    {
        $mailMessage->update($request->validate([
            'status' => ['required','in:pending,reviewed,archived'],
            'is_public' => ['nullable','boolean'],
        ]));
        return back()->with('status','Pesan diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailMessage $mailMessage)
    {
        $mailMessage->delete();
        return back()->with('status','Pesan dihapus.');
    }
}
