@extends('layouts.app')

@section('title', 'Dettagli Ordine')

@section('content')
    <h1>Dettagli Ordine #{{ $order->id }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cliente: {{ $order->customer_name }}</h5>
            <p class="card-text">Descrizione: {{ $order->description }}</p>
            <p class="card-text">Data: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <h2 class="mt-4">Prodotti associati</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Nome Prodotto</th>
            <th>Quantità</th>
            <th>Prezzo Unitario</th>
            <th>Totale</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>€{{ number_format($product->price, 2) }}</td>
                <td>€{{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Modifica Ordine</a>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Torna alla Lista</a>
@endsection
