<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(12);
        return view('products.index', compact('products', 'search'));
    }

    public function featured()
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->latest()
            ->get();
        return view('products.featured', compact('featuredProducts'));
    }

    public function popular()
    {
        $popularProducts = Product::with('category')
            ->orderBy('views', 'desc')
            ->paginate(12);
        return view('products.popular', compact('popularProducts'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $product->increment('views');
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function admin()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0|max:99999999.99',
            'image'       => 'nullable|url|max:2048',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
        ]);

        Product::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'image'       => $validated['image'] ?? null,
            'category_id' => $validated['category_id'],
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0|max:99999999.99',
            'image'       => 'nullable|url|max:2048',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
        ]);

        $product->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'image'       => $validated['image'] ?? null,
            'category_id' => $validated['category_id'],
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Producto eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(15);
        return view('admin.products.search', compact('products', 'query'));
    }
}