<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4><i class="bi bi-person-gear me-2"></i>Modifier le Vendeur</h4>
                        <a href="<?php echo e(route('vendeurs.index')); ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Affichage des erreurs -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulaire d'édition -->
                        <form action="<?php echo e(route('vendeurs.update', $vendeur)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- ID Vendeur (lecture seule) -->
                            <div class="mb-3">
                                <label for="ID_Vendeur" class="form-label">
                                    <i class="bi bi-hash me-1"></i>ID Vendeur
                                </label>
                                <input type="text"
                                       class="form-control-plaintext bg-light"
                                       id="ID_Vendeur"
                                       value="<?php echo e($vendeur->ID_Vendeur); ?>"
                                       readonly>
                                <small class="form-text text-muted">L'ID du vendeur ne peut pas être modifié</small>
                            </div>

                            <!-- Nom et Prénom -->
                            <div class="mb-3">
                                <label for="nom_prenom" class="form-label">
                                    <i class="bi bi-person me-1"></i>Nom et Prénom <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control <?php $__errorArgs = ['nom_prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="nom_prenom"
                                       name="nom_prenom"
                                       value="<?php echo e(old('nom_prenom', $vendeur->nom_prenom)); ?>"
                                       required
                                       placeholder="Jean Dupont">
                                <?php $__errorArgs = ['nom_prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-3">
                                <label for="tel" class="form-label">
                                    <i class="bi bi-telephone me-1"></i>Téléphone <span class="text-danger">*</span>
                                </label>
                                <input type="tel"
                                       class="form-control <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="tel"
                                       name="tel"
                                       value="<?php echo e(old('tel', $vendeur->tel)); ?>"
                                       required
                                       placeholder="06 12 34 56 78">
                                <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="mail" class="form-label">
                                    <i class="bi bi-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                       class="form-control <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="mail"
                                       name="mail"
                                       value="<?php echo e(old('mail', $vendeur->mail)); ?>"
                                       required
                                       placeholder="jean.dupont@exemple.com">
                                <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="mdp" class="form-label">
                                    <i class="bi bi-lock me-1"></i>Nouveau mot de passe
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="mdp"
                                           name="mdp"
                                           placeholder="Laissez vide pour conserver le mot de passe actuel">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('mdp')">
                                        <i class="bi bi-eye" id="mdp-icon"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">
                                    Laissez ce champ vide si vous ne souhaitez pas modifier le mot de passe
                                </small>
                                <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div class="mb-3">
                                <label for="mdp_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-1"></i>Confirmer le nouveau mot de passe
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="mdp_confirmation"
                                           name="mdp_confirmation"
                                           placeholder="Confirmez le nouveau mot de passe">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('mdp_confirmation')">
                                        <i class="bi bi-eye" id="mdp_confirmation-icon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="bi bi-check-lg me-1"></i>Mettre à jour
                                    </button>
                                    <a href="<?php echo e(route('vendeurs.show', $vendeur)); ?>" class="btn btn-outline-info">
                                        <i class="bi bi-eye me-1"></i>Voir
                                    </a>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('vendeurs.index')); ?>" class="btn btn-secondary">
                                        <i class="bi bi-x-lg me-1"></i>Annuler
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Informations supplémentaires -->
                        <hr class="mt-4">
                        <div class="row text-muted small">
                            <div class="col-md-6">
                                <i class="bi bi-calendar-plus me-1"></i>
                                Créé le: <?php echo e($vendeur->created_at?->format('d/m/Y H:i')); ?>

                            </div>
                            <div class="col-md-6 text-end">
                                <i class="bi bi-calendar-check me-1"></i>
                                Modifié le: <?php echo e($vendeur->updated_at?->format('d/m/Y H:i')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendeurs/edit.blade.php ENDPATH**/ ?>