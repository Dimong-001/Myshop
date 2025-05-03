<?php
// App/Http/Controllers/API/PublicApiController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;

class PublicApiController extends Controller
{
    // No auth middleware in constructor
    
    public function slideshows()
    {
        return Slideshow::all();
    }
}
