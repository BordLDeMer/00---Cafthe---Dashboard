<?php $__env->startSection('content'); ?>
    <h1>Détails du vendeur</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> <?php echo e($vendeur->ID_Vendeur); ?></p>
            <p><strong>Nom et Prénom:</strong> <?php echo e($vendeur->nom_prenom); ?></p>
            <p><strong>Téléphone:</strong> <?php echo e($vendeur->tel); ?></p>
            <p><strong>Email:</strong> <?php echo e($vendeur->mail); ?></p>
        </div>
    </div>
    <a href="<?php echo e(route('vendeurs.index')); ?>" class="btn btn-secondary mt-3">Retour</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendeurs/show.blade.php ENDPATH**/ ?>