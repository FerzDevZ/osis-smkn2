<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::where('expires_at', '>', now())
            ->latest()
            ->get();

        return response()->json([
            'stories' => $stories
        ]);
    }
}
