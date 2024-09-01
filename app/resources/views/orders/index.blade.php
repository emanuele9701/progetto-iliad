<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lista Ordini')
@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection
@section('content')
    <h1>Lista Ordini</h1>

    <table class="table" id="orders-table" data-url="{{ route('api.orders.lista') }}">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome Cliente</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Data</th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th>
                <input type="text" class="form-control" onkeyup="searchTextTable(this);">
            </th>
            <th></th>
            <th></th>
            <th>
                <input type="date" class="form-control" onchange="searchTextTable(this);">
            </th>
            <th></th>
        </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    @vite(['resources/js/orders.js','resources/js/lib/yadcf/yadcf.js'])
@endsection
