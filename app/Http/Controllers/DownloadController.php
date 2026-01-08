<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(20);
        return view('downloads.index', compact('downloads'));
    }

    public function adminIndex()
    {
        $downloads = Download::latest()->paginate(20);
        return view('downloads.admin-index', compact('downloads'));
    }

    public function create()
    {
        return view('downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240', // 10MB
            'category' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('downloads', 'public');
            $validated['file_path'] = $path;
            $validated['file_type'] = $request->file('file')->getClientOriginalExtension();
        }

        Download::create($validated);

        return redirect()->route('admin.downloads.index')->with('status', 'File berhasil diunggah.');
    }

    public function edit(Download $download)
    {
        return view('downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'category' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            if ($download->file_path) {
                Storage::disk('public')->delete($download->file_path);
            }
            $path = $request->file('file')->store('downloads', 'public');
            $validated['file_path'] = $path;
            $validated['file_type'] = $request->file('file')->getClientOriginalExtension();
        }

        $download->update($validated);

        return redirect()->route('admin.downloads.index')->with('status', 'File berhasil diperbarui.');
    }

    public function download(Download $download)
    {
        $download->increment('download_count');
        return Storage::disk('public')->download($download->file_path, $download->title . '.' . $download->file_type);
    }

    public function destroy(Download $download)
    {
        if ($download->file_path) {
            Storage::disk('public')->delete($download->file_path);
        }
        $download->delete();

        return back()->with('status', 'File berhasil dihapus.');
    }
}
