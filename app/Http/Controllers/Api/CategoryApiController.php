<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Category::where('is_active', true)
                    ->orderBy('id', 'desc')
                    ->get()
        );
    }
}

