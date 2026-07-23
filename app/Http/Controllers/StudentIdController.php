<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentIdController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile()->firstOrCreate(['user_id' => $user->id]);
        
        $qrData = route('profile.edit', ['id' => $user->id]);
        $qrCode = QrCode::size(200)->generate($qrData);

        return view('student-id.show', compact('user', 'profile', 'qrCode'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $validated = $request->validate([
            'nisn' => 'nullable|string|max:20',
            'grade' => 'nullable|string|max:10', // 10, 11, 12
            'major' => 'nullable|string|max:50', // TKJ, DKV, TKP
            'class' => 'nullable|string|max:10', // 1, 2, 3, 4
            'position' => 'nullable|string|max:50',
            'member_type' => 'required|in:student,osis',
        ]);

        $profile->update($validated);

        return back()->with('status', 'Profil ID Digital diperbarui!');
    }
}
