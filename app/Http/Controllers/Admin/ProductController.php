<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $validated['image'] = 'images/products/' . $imageName;
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $validated['image'] = 'images/products/' . $imageName;

            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
