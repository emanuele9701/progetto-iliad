<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home - Sistema di Gestione Ordini')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-4">Sistema di Gestione Ordini</h1>
        <p class="lead">Benvenuto nel tuo pannello di controllo per la gestione degli ordini giornalieri.</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Visualizza Ordini</h5>
                    <p class="card-text">Accedi all'elenco completo degli ordini con possibilità di filtraggio e ricerca.</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg btn-block">Lista Ordini</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Nuovo Ordine</h5>
                    <p class="card-text">Crea un nuovo ordine inserendo i dettagli del cliente e i prodotti.</p>
                    <a href="{{ route('orders.create') }}" class="btn btn-success btn-lg btn-block">Crea Ordine</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestione Prodotti</h5>
                    <p class="card-text">Visualizza, aggiungi o modifica i prodotti disponibili nel catalogo.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-info btn-lg btn-block">Catalogo Prodotti</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ordini Recenti</h5>
                    <ul class="list-group">
                        @foreach($recentOrders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ordine #{{ $order->id }} - {{ $order->customer_name }}
                                <span class="badge badge-primary badge-pill">{{ $order->created_at->format('d/m/Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistiche</h5>
                    <p>Totale ordini: <strong>{{ $totalOrders }}</strong></p>
                    <p>Ordini oggi: <strong>{{ $todayOrders }}</strong></p>
                    <p>Valore totale ordini: <strong>€{{ number_format($totalValue, 2) }}</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .jumbotron {
            background-color: #f8f9fa;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            border-radius: 0.3rem;
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-lg {
            padding: 0.75rem 1.25rem;
            font-size: 1.25rem;
        }
    </style>
@endsection
