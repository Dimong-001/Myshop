<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slideshow;
class IndexController extends Controller
{
    //
    public function index()
    {
        $slideshows = Slideshow::where('show','=',1)->get();
        return view('index', compact('slideshows'));
    }
}
