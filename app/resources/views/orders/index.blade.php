<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lista Ordini')

@section('content')
    <h1>Lista Ordini</h1>

    <div class="mb-3">
        <input type="date" id="date-filter" class="form-control d-inline-block w-auto">
        <input type="text" id="search-filter" class="form-control d-inline-block w-auto" placeholder="Cerca per nome o descrizione">
    </div>

    <table class="table" id="orders-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome Cliente</th>
            <th>Descrizione</th>
            <th>Data</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->description }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">Dettagli</a>
                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">Modifica</a>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo ordine?')">Elimina</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#date-filter, #search-filter').on('change keyup', function() {
                var date = $('#date-filter').val();
                var search = $('#search-filter').val().toLowerCase();

                $('#orders-table tbody tr').each(function() {
                    var row = $(this);
                    var rowDate = row.find('td:eq(3)').text();
                    var rowText = row.text().toLowerCase();

                    var dateMatch = !date || rowDate === date;
                    var searchMatch = !search || rowText.includes(search);

                    row.toggle(dateMatch && searchMatch);
                });
            });
        });
    </script>
@endsection
