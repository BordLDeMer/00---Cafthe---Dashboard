<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: linen;">
        <div class="row justify-content-center">
            <div class="col-md-120 mx-auto">
                <div class="card shadow" style="background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; width: 100%;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #5a3e2b; color: white; border: none; border-radius: 10px 10px 0 0 !important;">
                        <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Mon Profil</h4>
                    </div>
                    <div class="card-body" style="background-color: white; color: #5a3e2b; padding: 20px; width: 100%;">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <!-- Affichage des informations du vendeur -->
                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-hash me-2"></i>ID Vendeur:</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo e($vendeur->ID_Vendeur); ?>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-person me-2"></i>Nom et Prénom:</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo e($vendeur->nom_prenom); ?>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-telephone me-2"></i>Téléphone:</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo e($vendeur->tel); ?>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4" style="white-space: nowrap;">
                                <strong><i class="bi bi-envelope me-2"></i>Email:</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo e($vendeur->mail); ?>

                            </div>
                        </div>

                        <!-- Bouton pour modifier le profil -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="<?php echo e(route('vendeurs.edit', ['vendeur' => $vendeur->ID_Vendeur])); ?>" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 8px 15px;">
                                <i class="bi bi-pencil-square me-1"></i> Modifier mon profil
                            </a>
                        </div>

                        <!-- Informations supplémentaires -->
                        <hr class="mt-4" style="border-top: 1px solid #e9ecef;">
                        <div class="row text-muted small mt-3">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendeurs/profil.blade.php ENDPATH**/ ?>