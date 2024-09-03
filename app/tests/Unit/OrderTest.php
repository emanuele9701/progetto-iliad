<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_order_can_be_created()
    {
        $order = Order::create([
            'name' => 'Test Order',
            'description' => 'Test Description',
            'order_date' => now(),
            'total_value' => 100.00,
        ]);

        $this->assertDatabaseHas('orders', [
            'name' => 'Test Order',
            'description' => 'Test Description',
            'total_value' => 100.00,
        ]);
    }

    /** @test */
    public function an_order_can_have_products()
    {
        $order = Order::create([
            'name' => 'Test Order',
            'description' => 'Test Description',
            'order_date' => now(),
            'total_value' => 0,
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'price' => 50.00,
        ]);

        $order->products()->attach($product->id, ['qty' => 2]);

        $this->assertDatabaseHas('products_order', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'qty' => 2,
        ]);
    }
}
