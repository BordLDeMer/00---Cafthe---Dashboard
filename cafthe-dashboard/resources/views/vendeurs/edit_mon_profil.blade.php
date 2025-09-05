@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-120 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-left" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Modifier Mon Profil</h4>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 20px;">
                        <form action="{{ route('vendeurs.mettre_a_jour_mon_profil') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-4" style="white-space: nowrap;">
                                    <label for="nom_prenom"><strong><i class="bi bi-person me-2"></i>Nom et Prénom:</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="{{ old('nom_prenom', $vendeur->nom_prenom) }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4" style="white-space: nowrap;">
                                    <label for="tel"><strong><i class="bi bi-telephone me-2"></i>Téléphone:</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', $vendeur->tel) }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4" style="white-space: nowrap;">
                                    <label for="mail"><strong><i class="bi bi-envelope me-2"></i>Email:</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="mail" name="mail" value="{{ old('mail', $vendeur->mail) }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4" style="white-space: wrap; padding-bottom: 5px;">
                                    <label for="mdp"><strong><i class="bi bi-lock me-2"></i>Mot de passe (laisser vide pour ne pas changer):</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="mdp" name="mdp">
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('vendeurs.mon_profil') }}" class="btn me-2" style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px 15px;">
                                    <i class="bi bi-x-lg me-1"></i>Annuler
                                </a>
                                <button type="submit" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 8px 15px;">
                                    <i class="bi bi-save me-1"></i>Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
