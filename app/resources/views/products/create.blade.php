@extends('layouts.app')

@section('title', 'Aggiungi Nuovo Prodotto')

@section('content')
    <div class="container">
        <h1 class="mb-4">Aggiungi Nuovo Prodotto</h1>

        <form id="productForm" action="{{ isset($product) ? route('products.update') : route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome Prodotto</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">Il nome del prodotto è obbligatorio.</div>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Prezzo</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">€</span>
                    </div>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                    <div class="invalid-feedback">Inserisci un prezzo valido.</div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Prodotto</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                // Reset previous error states
                $('.is-invalid').removeClass('is-invalid');

                // Validate form
                let isValid = true;

                if ($('#name').val().trim() === '') {
                    $('#name').addClass('is-invalid');
                    isValid = false;
                }

                if ($('#price').val() === '' || parseFloat($('#price').val()) < 0) {
                    $('#price').addClass('is-invalid');
                    isValid = false;
                }

                if (isValid) {
                    // If valid, submit the form
                    this.submit();
                } else {
                    // If not valid, show error message
                    alert('Per favore, correggi gli errori nel form prima di inviare.');
                }
            });

            // Real-time validation
            $('#name, #price').on('input', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>
@endsection
