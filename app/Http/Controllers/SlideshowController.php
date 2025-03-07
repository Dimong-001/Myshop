<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slideshow; // Ensure this matches the correct model location

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::orderBy('order', 'asc')->get();
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
    public function enable_disable($id){
        $slideshow=Slideshow::find($id);
        if($slideshow->show==1){
            $slideshow->show=0;
        }else{
            $slideshow->show=1;
        }
        $slideshow->save();
        return redirect('/slideshow');
    }
    
    public function move_up($id)
    {
        $slideshow = Slideshow::findOrFail($id);

        // Find the previous slideshow (one step above)
        $previous = Slideshow::where('order', '<', $slideshow->order)
                            ->orderBy('order', 'desc')
                            ->first();

        if ($previous) {
            // Swap order values
            $currentOrder = $slideshow->order;
            $slideshow->order = $previous->order;
            $previous->order = $currentOrder;

            // Save the changes
            $slideshow->save();
            $previous->save();
        }

        return redirect()->route('slideshow.index')->with('success', 'Slideshow moved up successfully!');
    }
    public function move_down($id)
    {
        $slideshow = Slideshow::findOrFail($id);

        // Find the next slideshow (one step below)
        $next = Slideshow::where('order', '>', $slideshow->order)
                        ->orderBy('order', 'asc')
                        ->first();

        if ($next) {
            // Swap order values
            $currentOrder = $slideshow->order;
            $slideshow->order = $next->order;
            $next->order = $currentOrder;

            // Save the changes
            $slideshow->save();
            $next->save();
        }

        return redirect()->route('slideshow.index')->with('success', 'Slideshow moved down successfully!');
    }

    public function loadSlideshowForm()
    {
        return view('admin.create_slideshow'); // Ensure this Blade file exists
    }
}

