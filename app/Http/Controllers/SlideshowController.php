<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slideshow; // Ensure this matches the correct model location

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::all();
        return view('admin.slideshow', compact('slideshows'));
    }
    // public function destroy($id)
    // {
    //     // Find the slideshow, or fail with a 404 if not found
    //     $slideshow = Slideshow::findOrFail($id);
    
    //     // Delete the slideshow
    //     $slideshow->delete();
    
    //     // Redirect back to the slideshow index page with a success message
    //     return redirect()->route('slideshow.index')->with('success', 'Slideshow deleted successfully!');
    // }
    public function destroy($id)
    {
        try {
            $slideshow = Slideshow::findOrFail($id);
            $slideshow->delete();

            return redirect()->route('slideshow.index')->with('success', 'Slideshow deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('slideshow.index')->with('error', 'Failed to delete slideshow. Please try again.');
        }
    }
    
}

