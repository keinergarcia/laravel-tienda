<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Mostrar contenido del carrito.
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $cartItem) {
            $product = Product::find($productId);

            if (! $product) {
                continue;
            }

            $quantity = $cartItem['quantity'];
            $discountedPrice = $product->price * 0.9;
            $itemTotal = $discountedPrice * $quantity;

            $items[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
                'itemTotal' => $itemTotal,
            ];

            $subtotal += $product->price * $quantity;
        }

        $discount = $subtotal * 0.10;
        $total = $subtotal - $discount;

        $cartSummary = [
            'items' => $items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];

        return view('cart.index', compact('cartSummary'));
    }

    /**
     * Agregar producto al carrito.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = min(99, $cart[$productId]['quantity'] + $quantity);
        } else {
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Actualizar cantidad de un producto.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado.');
    }

    /**
     * Quitar producto del carrito.
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Vaciar el carrito.
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado.');
    }
}
