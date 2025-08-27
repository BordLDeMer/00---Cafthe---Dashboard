<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; width: 200%; height: 100%;">
                    <div class="card-header text-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important; padding: 15px;">
                        <h4 class="mb-0"><i class="bi bi-person me-2"></i>Connexion Vendeur</h4>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 25px;">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <!-- Champ Email -->
                            <div class="mb-3">
                                <label for="mail" class="form-label" style="color: #5a3e2b; font-weight: 500;">
                                    <i class="bi bi-envelope me-2"></i>Adresse Email
                                </label>
                                <input id="mail" type="email" class="form-control <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="mail" value="<?php echo e(old('mail')); ?>" required autocomplete="email" autofocus
                                       style="border-radius: 5px; border: 1px solid #ced4da; padding: 10px; width: 100%;">
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
                            <!-- Champ Mot de passe -->
                            <div class="mb-3">
                                <label for="mdp" class="form-label" style="color: #5a3e2b; font-weight: 500;">
                                    <i class="bi bi-lock me-2"></i>Mot de passe
                                </label>
                                <div class="input-group">
                                    <input id="mdp" type="password" class="form-control <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="mdp" required autocomplete="current-password"
                                           style="border-radius: 5px 0 0 5px; border: 1px solid #ced4da; padding: 10px; width: 100%;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mdp')"
                                            style="background-color: #f8f9fa; border-radius: 0 5px 5px 0; border: 1px solid #ced4da; padding: 10px 12px;">
                                        <i class="bi bi-eye" id="mdp-icon"></i>
                                    </button>
                                </div>
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
                            <!-- Option Se souvenir de moi -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="remember" style="color: #5a3e2b; font-weight: 500;">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <!-- Bouton de soumission -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 10px; font-weight: 500;">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Se connecter
                                </button>
                            </div>
                            <!-- Lien Mot de passe oublié -->
                            <div class="text-center mt-3">
                                <?php if(Route::has('password.request')): ?>
                                    <a href="<?php echo e(route('password.request')); ?>" style="color: #5a3e2b; text-decoration: none; font-weight: 500;">
                                        Mot de passe oublié ?
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                    <!-- Pied de carte -->
                    <div class="card-footer text-center" style="background-color: #e9ecef; border: none; border-radius: 0 0 10px 10px !important; padding: 15px;">
                        <p class="mb-0" style="font-size: 0.9em; color: #5a3e2b;">
                            <i class="bi bi-info-circle me-1"></i>Besoin d'aide ? Contactez l'administrateur.
                        </p>
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/auth/login.blade.php ENDPATH**/ ?>