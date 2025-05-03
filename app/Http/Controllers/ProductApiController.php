<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json(Product::latest()->get());
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/products'), $name);
            $validated['image'] = 'images/products/' . $name;
        }

        return response()->json(Product::create($validated), 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($request->name ?? $product->name);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/products'), $name);
            $validated['image'] = 'images/products/' . $name;

            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
        }

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();

        return response()->json(['message' => 'Deleted'], 204);
    }
}

