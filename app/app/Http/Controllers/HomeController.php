<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentOrders = Order::with('products')->latest()->take(5)->get();
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalValue = Order::sum('total_value');

        return view('home', compact('recentOrders', 'totalOrders', 'todayOrders', 'totalValue'));
    }
}
