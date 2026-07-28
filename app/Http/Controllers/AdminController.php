<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalProducts'   => Product::count(),
            'totalCategories' => Category::count(),
            'totalUsers'      => User::count(),
            'totalOrders'     => Order::count(),
            'pendingOrders'   => Order::where('status', 'pending')->count(),
            'featuredProducts' => Product::where('is_featured', true)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders', 'recentProducts'));
    }
}