@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-20 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h2 class="mb-0" style="color: white;">Détails du Client</h2>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b;">
                        <!-- Utilisation de d-flex align-items-center pour éviter les retours à la ligne -->
                        <div class="row mb-3 d-flex align-items-center">
                            <div class="col-md-5 d-flex align-items-center">
                                <strong>ID Client:</strong>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                {{ $client->ID_client }}
                            </div>
                        </div>
                        <div class="row mb-3 d-flex align-items-center">
                            <div class="col-md-6 d-flex align-items-center">
                                <strong>Nom Prénom:</strong>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                {{ $client->nom_prenom }}
                            </div>
                        </div>
                        <div class="row mb-3 d-flex align-items-center">
                            <div class="col-md-4 d-flex align-items-center">
                                <strong>Téléphone:</strong>
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                {{ $client->tel }}
                            </div>
                        </div>
                        <div class="row mb-3 d-flex align-items-center">
                            <div class="col-md-4 d-flex align-items-center">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                {{ $client->mail }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #e9ecef; border: none; border-radius: 0 0 10px 10px !important;">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('clients.edit', $client->ID_client) }}" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="{{ route('clients.index') }}" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
