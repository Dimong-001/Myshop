<?php

namespace App\Http\Controllers;

// use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\Slideshow; // Ensure this matches the correct model location
use Illuminate\Support\Facades\Validator;

class SlideshowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function create(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'text' => 'required|string',
            'link' => 'required|string|max:255',
            'show' => 'nullable|boolean',
            'order' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $slideshow = new Slideshow();
        $slideshow->title = $request->title;
        $slideshow->subtitle = $request->subtitle;
        $slideshow->text = $request->text;
        $slideshow->link = $request->link;
        $slideshow->show = $request->show ? 1 : 0;
        $slideshow->order = $request->order ?? 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'slide-' . time() . '.' . $image->getClientOriginalExtension();
        
            // ✅ Define the path using public_path()
            $destinationPath = public_path('assets/images/demos/demo-3/slider');
        
            // ✅ Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
        
            // ✅ Move file to destination
            if ($image->move($destinationPath, $filename)) {
                // ✅ ONLY SAVE THE FILENAME to the database!
                $slideshow->image = $filename;
            } else {
                dd('Failed to move file');
            }
        }
        
        
        $slideshow->created_at = now();
        $slideshow->updated_at = now();

        $slideshow->save();

        return redirect()->route('slideshow.index')->with('success', 'Slideshow created successfully!');
    }
    
     // This is your new API endpoint
    public function apiIndex()
    {
        try {
            $slideshows = Slideshow::where('show', 1)
                ->orderBy('order', 'asc')
                ->get(['id', 'title', 'subtitle', 'text', 'image', 'link']);
                
            return response()->json($slideshows);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch slideshows', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

}

