<!-- resources/views/orders/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Modifica Ordine')

@section('content')
    <h1>Modifica Ordine #{{ $order->id }}</h1>

    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_name">Nome Cliente</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $order->description) }}</textarea>
        </div>

        <h2 class="mt-4">Prodotti</h2>
        <div id="products-container">
            @foreach($order->products as $index => $product)
                <div class="product-row mb-3">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="products[{{ $index }}][name]" value="{{ $product->name }}" placeholder="Nome Prodotto" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="products[{{ $index }}][quantity]" value="{{ $product->pivot->quantity }}" placeholder="Quantità" required>
                        </div>
                        <div class="col">
                            <input type="number" step="0.01" class="form-control" name="products[{{ $index }}][price]" value="{{ $product->price }}" placeholder="Prezzo" required>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger remove-product">Rimuovi</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-product" class="btn btn-secondary mb-3">Aggiungi Prodotto</button>

        <div>
            <button type="submit" class="btn btn-primary">Aggiorna Ordine</button>
            <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annulla</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let productIndex = {{ $order->products->count() }};

            $('#add-product').click(function() {
                const newProduct = `
            <div class="product-row mb-3">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="products[${productIndex}][name]" placeholder="Nome Prodotto" required>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="products[${productIndex}][quantity]" placeholder="Quantità" required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="products[${productIndex}][price]" placeholder="Prezzo" required>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-product">Rimuovi</button>
                    </div>
                </div>
            </div>
        `;
                $('#products-container').append(newProduct);
                productIndex++;
            });

            $(document).on('click', '.remove-product', function() {
                $(this).closest('.product-row').remove();
            });
        });
    </script>
@endsection
