<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'order_date' => $this->order_date, // Formattato come stringa data/ora
            'total_value' => number_format($this->total_value, 2), // Formattato con due decimali
            'products' => $this->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => number_format($product->price, 2),
                    'qty' => $product->pivot->qty, // Accesso al campo qty dalla tabella pivot
                ];
            }), // Usa una Resource anche per i prodotti
        ];
    }
}
