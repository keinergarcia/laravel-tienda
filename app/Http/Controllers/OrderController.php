<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkoutForm()
    {
        $cartSession = Session::get('cart', []);
        if (empty($cartSession)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $items = [];
        $subtotal = 0;

        foreach ($cartSession as $productId => $data) {
            $product = Product::find($productId);
            if (! $product) continue;

            $quantity = $data['quantity'];
            $itemTotal = $product->price * $quantity;
            $subtotal += $itemTotal;

            $items[] = [
                'id'        => $product->id,
                'name'      => $product->name,
                'price'     => $product->price,
                'quantity'  => $quantity,
                'itemTotal' => $itemTotal,
            ];
        }

        $discount = $subtotal * 0.10;
        $total = $subtotal - $discount;

        $cartSummary = [
            'items'    => $items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => $total,
        ];

        if (empty($cartSummary['items'])) {
            Session::forget('cart');

            return redirect()->route('cart.index')->with('error', 'Los productos del carrito ya no están disponibles.');
        }

        return view('orders.checkout', compact('cartSummary'));
    }

    /**
     * Procesa y guarda un nuevo pedido desde el checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:30',
            'city'    => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'notes'   => 'nullable|string|max:500',
        ]);

        $cartSession = Session::get('cart', []);
        if (empty($cartSession)) {
            return redirect()->route('cart.index')
                             ->with('error', 'Tu carrito está vacío.');
        }

        $items = [];
        $subtotal = 0;

        foreach ($cartSession as $productId => $data) {
            $product = Product::find($productId);
            if (! $product) continue;

            $quantity = $data['quantity'];
            $itemTotal = $product->price * $quantity;
            $subtotal += $itemTotal;

            $items[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity'   => $quantity,
                'price'      => $product->price,
            ];
        }

        if (empty($items)) {
            Session::forget('cart');

            return redirect()->route('cart.index')->with('error', 'Los productos del carrito ya no están disponibles.');
        }

        $discount = $subtotal * 0.10;
        $total = $subtotal - $discount;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'  => Auth::id(),
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'city'     => $request->city,
                'address'  => $request->address,
                'notes'    => $request->notes,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total'    => $total,
                'status'   => 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('checkout.confirmation', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('error', 'Error procesando tu pedido.');
        }
    }

    /**
     * Muestra el historial de pedidos.
     */
    public function history()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }

    /**
     * Muestra un pedido específico.
     */
    public function show(int $id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        abort_unless($order->user_id === Auth::id(), 403);

        return view('orders.show', compact('order'));
    }

    /**
     * Vista de confirmación tras la compra.
     */
    public function confirmation(int $id)
    {
        $order = Order::findOrFail($id);
        abort_unless($order->user_id === Auth::id(), 403);

        return view('orders.confirmation', ['orderId' => $order->id]);
    }
}
