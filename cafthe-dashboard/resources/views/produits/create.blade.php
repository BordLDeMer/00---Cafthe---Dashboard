@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px; height: 100%;">
                <div class="card-header" style="background-color: #5a3e2b; color: #fff; border-radius: 10px 10px 0 0;">
                    <strong>Ajouter un produit</strong>
                </div>
                <div class="card-body" style="background-color: #fff">
                    <style>
                        .form-label { color: #000 !important; text-align: left !important; }
                        .form-check-label { color: #000 !important; text-align: left !important; }
                        .form-control { text-align: left; }
                    </style>
                    <form action="{{ route('produits.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Désignation</label>
                            <input type="text" name="designation_produit" value="{{ old('designation_produit') }}" class="form-control" required>
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Type de produit</label>
                            <input list="types" name="type_produit" value="{{ old('type_produit') }}" class="form-control">
                            <datalist id="types">
                                @isset($typesProduits)
                                    @foreach($typesProduits as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                @endisset
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix TTC (€)</label>
                            <input type="number" step="0.01" min="0" name="prix_ttc" value="{{ old('prix_ttc') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Rayon</label>
                            <input type="number" name="ID_rayon" value="{{ old('ID_rayon') }}" class="form-control">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <!-- Ensure a value is always submitted: 0 when unchecked, 1 when checked -->
                            <input type="hidden" name="solde" value="0">
                            <input class="form-check-input" type="checkbox" id="solde" name="solde" value="1" {{ old('solde') ? 'checked' : '' }}>
                            <label class="form-check-label" for="solde">En solde</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('produits.index') }}" class="btn" style="background-color: #6c757d; color: white;">Annuler</a>
                            <button type="submit" class="btn" style="background-color: #82C46C; color: #5a3e2b; font-weight: bold;">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
