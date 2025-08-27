@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-gear me-2"></i>Modifier le client : {{ $client->nom_prenom }}</h4>
                        <a href="{{ route('clients.index') }}" class="btn" style="background-color: rgba(255, 255, 255, 0.2); color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none;">
                            <i class="bi bi-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 20px;">
                        <!-- Affichage des erreurs -->
                        @if ($errors->any())
                            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: none; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
                                <ul class="mb-0" style="padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulaire d'édition -->
                        <form action="{{ route('clients.update', $client->ID_client) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nom et Prénom -->
                            <div class="mb-3">
                                <label for="nom_prenom" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-person me-2"></i>Nom et Prénom
                                </label>
                                <input type="text"
                                       class="form-control @error('nom_prenom') is-invalid @enderror"
                                       id="nom_prenom"
                                       name="nom_prenom"
                                       value="{{ old('nom_prenom', $client->nom_prenom) }}"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('nom_prenom')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-3">
                                <label for="tel" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-telephone me-2"></i>Téléphone
                                </label>
                                <input type="text"
                                       class="form-control @error('tel') is-invalid @enderror"
                                       id="tel"
                                       name="tel"
                                       value="{{ old('tel', $client->tel) }}"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('tel')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="mail" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <input type="email"
                                       class="form-control @error('mail') is-invalid @enderror"
                                       id="mail"
                                       name="mail"
                                       value="{{ old('mail', $client->mail) }}"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('mail')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="mdp" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-lock me-2"></i>Mot de passe
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control @error('mdp') is-invalid @enderror"
                                           id="mdp"
                                           name="mdp"
                                           placeholder="Laissez vide pour conserver le mot de passe actuel"
                                           style="border-radius: 5px 0 0 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('mdp')"
                                            style="background-color: #f8f9fa; border-radius: 0 5px 5px 0; border: 1px solid #ced4da; padding: 8px 12px;">
                                        <i class="bi bi-eye" id="mdp-icon"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted" style="color: #6c757d !important;">
                                    Laisser ce champ vide pour conserver le mot de passe actuel
                                </small>
                                @error('mdp')
                                <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="submit" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none; margin-right: 10px;">
                                        <i class="bi bi-check-lg me-1"></i>Mettre à jour
                                    </button>
                                </div>
                                <div>
                                    <a href="{{ route('clients.index') }}" class="btn" style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                        <i class="bi bi-x-lg me-1"></i>Annuler
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Informations supplémentaires -->
                        <div class="card-footer" style="background-color: #e9ecef; border: none; border-radius: 0 0 10px 10px !important; padding: 15px; margin-top: 20px;">
                            <div class="row" style="font-size: 0.9em; color: #5a3e2b;">
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="bi bi-calendar-plus me-2" style="color: #8b7355;"></i>
                                    <span>Créé le: <strong>{{ $client->created_at?->format('d/m/Y H:i') }}</strong></span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <i class="bi bi-calendar-check me-2" style="color: #8b7355;"></i>
                                    <span>Modifié le: <strong>{{ $client->updated_at?->format('d/m/Y H:i') }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // Formatage automatique du numéro de téléphone
        document.getElementById('tel').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.replace(/(\d{2})(?=\d)/g, '$1 ');
            }
            e.target.value = value;
        });

        // Vérification avant de quitter si des modifications ont été apportées
        const form = document.querySelector('form');
        const cancelBtn = document.querySelector('a[href*="clients.index"]');
        let formChanged = false;
        form.addEventListener('input', () => {
            formChanged = true;
        });
        cancelBtn.addEventListener('click', (e) => {
            if (formChanged && !confirm('Des modifications non sauvegardées seront perdues. Continuer ?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
