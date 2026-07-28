<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Mostrar listado público de categorías y productos filtrados.
     */
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category');
        $search = $request->input('search');

        // Obtener todas las categorías con conteo de productos
        $categoryCounts = Category::withCount('products')->get()->pluck('products_count', 'name');

        // Obtener productos filtrados por categoría y/o búsqueda
        $filteredProducts = Product::with('category')
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('name', $selectedCategory);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('categories.index', [
            'categoryCounts'   => $categoryCounts,
            'filteredProducts' => $filteredProducts,
        ]);
    }

    /**
     * Mostrar listado administrativo de categorías.
     */
    public function admin()
    {
        $this->ensureAdmin();

        $categories = Category::orderBy('name')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Mostrar formulario para crear categoría.
     */
    public function create()
    {
        $this->ensureAdmin();

        return view('admin.categories.create');
    }

    /**
     * Guardar nueva categoría.
     */
    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar formulario para editar categoría.
     */
    public function edit($id)
    {
        $this->ensureAdmin();

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Actualizar categoría existente.
     */
    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar categoría si no es protegida.
     */
    public function destroy($id)
    {
        $this->ensureAdmin();

        $category = Category::findOrFail($id);

        if ($category->id <= 4) {
            return redirect()->route('admin.categories')
                ->with('error', 'No se puede eliminar una categoría del sistema.');
        }

        if ($category->products()->exists()) {
            return redirect()->route('admin.categories')
                ->with('error', 'No se puede eliminar una categoría con productos asociados.');
        }

        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(Auth::check() && Auth::user()->isAdmin(), 403);
    }
}
