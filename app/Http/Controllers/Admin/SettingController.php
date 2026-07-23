<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        $imageKeys = ['hero_image', 'logo_image', 'about_image', 'favicon_image'];
        foreach ($imageKeys as $imgKey) {
            if ($request->hasFile($imgKey)) {
                $file = $request->file($imgKey);
                $path = $file->store('settings', 'public');
                Setting::updateOrCreate(['key' => $imgKey], ['value' => 'storage/' . $path]);
                unset($data[$imgKey]);
            }
        }

        foreach ($data as $key => $value) {
            if ($value !== null) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return back()->with('status', 'Pengaturan & gambar berhasil diperbarui!');
    }
}
