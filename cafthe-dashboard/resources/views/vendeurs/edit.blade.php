@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-gear me-2"></i>Modifier le Vendeur</h4>
                        <a href="{{ route('vendeurs.index') }}" class="btn" style="background-color: rgba(255, 255, 255, 0.2); color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none;">
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
                        <form action="{{ route('vendeurs.update', $vendeur) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- ID Vendeur (lecture seule) -->
                            <div class="mb-3">
                                <label for="ID_Vendeur" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-hash me-1"></i>ID Vendeur
                                </label>
                                <input type="text"
                                       class="form-control-plaintext"
                                       id="ID_Vendeur"
                                       value="{{ $vendeur->ID_Vendeur }}"
                                       readonly
                                       style="background-color: #f8f9fa; color: #5a3e2b; border-radius: 5px; padding: 8px; width: 100%;">
                                <small class="form-text text-muted" style="color: #6c757d !important;">L'ID du vendeur ne peut pas être modifié</small>
                            </div>

                            <!-- Nom et Prénom -->
                            <div class="mb-3">
                                <label for="nom_prenom" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-person me-1"></i>Nom et Prénom <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('nom_prenom') is-invalid @enderror"
                                       id="nom_prenom"
                                       name="nom_prenom"
                                       value="{{ old('nom_prenom', $vendeur->nom_prenom) }}"
                                       required
                                       placeholder="Jean Dupont"
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('nom_prenom')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-3">
                                <label for="tel" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-telephone me-1"></i>Téléphone <span class="text-danger">*</span>
                                </label>
                                <input type="tel"
                                       class="form-control @error('tel') is-invalid @enderror"
                                       id="tel"
                                       name="tel"
                                       value="{{ old('tel', $vendeur->tel) }}"
                                       required
                                       placeholder="06 12 34 56 78"
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('tel')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="mail" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                       class="form-control @error('mail') is-invalid @enderror"
                                       id="mail"
                                       name="mail"
                                       value="{{ old('mail', $vendeur->mail) }}"
                                       required
                                       placeholder="jean.dupont@exemple.com"
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                @error('mail')
                                <div class="invalid-feedback" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="mdp" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-lock me-1"></i>Nouveau mot de passe
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
                                    Laissez ce champ vide si vous ne souhaitez pas modifier le mot de passe
                                </small>
                                @error('mdp')
                                <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div class="mb-3">
                                <label for="mdp_confirmation" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-lock-fill me-1"></i>Confirmer le nouveau mot de passe
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="mdp_confirmation"
                                           name="mdp_confirmation"
                                           placeholder="Confirmez le nouveau mot de passe"
                                           style="border-radius: 5px 0 0 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('mdp_confirmation')"
                                            style="background-color: #f8f9fa; border-radius: 0 5px 5px 0; border: 1px solid #ced4da; padding: 8px 12px;">
                                        <i class="bi bi-eye" id="mdp_confirmation-icon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="submit" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none; margin-right: 10px;">
                                        <i class="bi bi-check-lg me-1"></i>Mettre à jour
                                    </button>
                                    <a href="{{ route('vendeurs.show', $vendeur) }}" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                        <i class="bi bi-eye me-1"></i>Voir
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('vendeurs.index') }}" class="btn" style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
                                        <i class="bi bi-x-lg me-1"></i>Annuler
                                    </a>
                                </div>
                            </div>
                        </form>

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

@section('scripts')
    <script>
        // Fonction pour afficher/masquer les mots de passe
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

        // Validation de la confirmation du mot de passe
        document.getElementById('mdp_confirmation').addEventListener('input', function() {
            const password = document.getElementById('mdp').value;
            const confirmation = this.value;
            if (password !== confirmation && confirmation !== '') {
                this.setCustomValidity('Les mots de passe ne correspondent pas');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
            }
        });

        // Vérification avant de quitter si des modifications ont été apportées
        const form = document.querySelector('form');
        const cancelBtn = document.querySelector('a[href*="vendeurs.index"]');
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
