@extends('layouts.app')

@section('title', 'Dettagli Prodotto')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">{{ $product->name }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p><strong>ID:</strong> {{ $product->id }}</p>
                                <p><strong>Descrizione:</strong> {{ $product->description ?: 'Nessuna descrizione disponibile' }}</p>
                                <p><strong>Prezzo:</strong> €{{ number_format($product->price, 2) }}</p>
                                <p><strong>Creato il:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
                                <p><strong>Ultimo aggiornamento:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Modifica</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')">Elimina</button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary float-right">Torna alla lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-header h1 {
            font-size: 1.5rem;
        }
        .fas {
            font-size: 4rem;
        }
    </style>
@endsection
