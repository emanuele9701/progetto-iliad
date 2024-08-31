<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->latest()->paginate(15);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'description' => $validatedData['description'],
        ]);

        $totalValue = 0;
        foreach ($validatedData['products'] as $productData) {
            $product = Product::find($productData['id']);
            $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            $totalValue += $product->price * $productData['quantity'];
        }

        $order->update(['total_value' => $totalValue]);

        return redirect()->route('orders.show', $order)->with('success', 'Ordine creato con successo.');
    }

    public function show(Order $order)
    {
        $order->load('products');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = Product::all();
        $order->load('products');
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order->update([
            'customer_name' => $validatedData['customer_name'],
            'description' => $validatedData['description'],
        ]);

        $order->products()->detach();

        $totalValue = 0;
        foreach ($validatedData['products'] as $productData) {
            $product = Product::find($productData['id']);
            $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            $totalValue += $product->price * $productData['quantity'];
        }

        $order->update(['total_value' => $totalValue]);

        return redirect()->route('orders.show', $order)->with('success', 'Ordine aggiornato con successo.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Ordine eliminato con successo.');
    }

    public function apiIndex(Request $request)
    {
        $query = Order::with('products');

        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(15);

        return response()->json($orders);
    }
}
