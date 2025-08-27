@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Détails du Vendeur</h4>
                        <a href="{{ route('vendeurs.index') }}" class="btn" style="background-color: rgba(255, 255, 255, 0.2); color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none;">
                            <i class="bi bi-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 20px;">
                        <!-- Utilisation de d-flex et align-items-center pour chaque ligne -->
                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-hash me-2"></i>ID Vendeur:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $vendeur->ID_Vendeur }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-person me-2"></i>Nom et Prénom:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $vendeur->nom_prenom }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-telephone me-2"></i>Téléphone:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $vendeur->tel }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-envelope me-2"></i>Email:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $vendeur->mail }}
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('vendeurs.edit', $vendeur) }}" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none; margin-right: 10px;">
                                    <i class="bi bi-pencil-square me-1"></i>Modifier
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('vendeurs.index') }}" class="btn" style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                    <i class="bi bi-x-lg me-1"></i>Retour
                                </a>
                            </div>
                        </div>

                        <!-- Informations supplémentaires -->
                        <hr class="mt-4" style="border-top: 1px solid #e9ecef;">
                        <div class="row text-muted small mt-3">
                            <div class="col-md-6">
                                <i class="bi bi-calendar-plus me-1"></i>
                                Créé le: {{ $vendeur->created_at?->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-md-6 text-end">
                                <i class="bi bi-calendar-check me-1"></i>
                                Modifié le: {{ $vendeur->updated_at?->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
