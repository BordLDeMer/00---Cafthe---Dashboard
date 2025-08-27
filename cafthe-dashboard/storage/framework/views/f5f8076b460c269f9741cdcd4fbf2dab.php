<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-gear me-2"></i>Modifier le client : <?php echo e($client->nom_prenom); ?></h4>
                        <a href="<?php echo e(route('clients.index')); ?>" class="btn" style="background-color: rgba(255, 255, 255, 0.2); color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none;">
                            <i class="bi bi-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 20px;">
                        <!-- Affichage des erreurs -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: none; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
                                <ul class="mb-0" style="padding-left: 20px;">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulaire d'édition -->
                        <form action="<?php echo e(route('clients.update', $client->ID_client)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Nom et Prénom -->
                            <div class="mb-3">
                                <label for="nom_prenom" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-person me-2"></i>Nom et Prénom
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
                                       value="<?php echo e(old('nom_prenom', $client->nom_prenom)); ?>"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                <?php $__errorArgs = ['nom_prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback" style="color: #dc3545;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-3">
                                <label for="tel" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-telephone me-2"></i>Téléphone
                                </label>
                                <input type="text"
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
                                       value="<?php echo e(old('tel', $client->tel)); ?>"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback" style="color: #dc3545;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="mail" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-envelope me-2"></i>Email
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
                                       value="<?php echo e(old('mail', $client->mail)); ?>"
                                       required
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 8px; width: 100%;">
                                <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback" style="color: #dc3545;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="mdp" class="form-label" style="color: #5a3e2b; white-space: nowrap;">
                                    <i class="bi bi-lock me-2"></i>Mot de passe
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
                                <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block" style="color: #dc3545;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="submit" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none; margin-right: 10px;">
                                        <i class="bi bi-check-lg me-1"></i>Mettre à jour
                                    </button>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('clients.index')); ?>" class="btn" style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px 15px; text-decoration: none;">
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
                                    <span>Créé le: <strong><?php echo e($client->created_at?->format('d/m/Y H:i')); ?></strong></span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <i class="bi bi-calendar-check me-2" style="color: #8b7355;"></i>
                                    <span>Modifié le: <strong><?php echo e($client->updated_at?->format('d/m/Y H:i')); ?></strong></span>
                                </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/clients/edit.blade.php ENDPATH**/ ?>