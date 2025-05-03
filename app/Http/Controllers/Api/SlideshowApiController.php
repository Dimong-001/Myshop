<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;

class SlideshowAPIController extends Controller
{
    public function index()
    {
        try {
            $slideshows = Slideshows::all();
            return response()->json($slideshows);
        } catch (\Exception $e) {
            \Log::error('Slideshow API error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch slideshows'], 500);
        }
    }

    public function show($id)
    {
        try {
            $slideshow = Slideshow::findOrFail($id);
            return response()->json($slideshow);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Slideshow not found'], 404);
        }
    }
}
