<?php $__env->startSection('content'); ?>
    <h1>Modifier le vendeur : <?php echo e($vendeur->nom_prenom); ?></h1>
    <form action="<?php echo e(route('vendeurs.update', $vendeur->ID_vendeur)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="nom_prenom" class="form-label">Nom et Prénom</label>
            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="<?php echo e($vendeur->nom_prenom); ?>" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?php echo e($vendeur->tel); ?>" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?php echo e($vendeur->mail); ?>" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe (laisser vide pour conserver)</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Laisser vide pour conserver le mot de passe actuel">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="<?php echo e(route('vendeurs.show', $vendeur)); ?>" class="btn btn-info btn-sm">Voir</a>
        <a href="<?php echo e(route('vendeurs.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
<?php $__env->stopSection(); ?>
<?php $__currentLoopData = $vendeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p>ID: <?php echo e($vendeur->ID_Vendeur ?? 'NULL'); ?></p>
    <p>Vendeur: <?php echo e(print_r($vendeur->toArray(), true)); ?></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendeurs/update.blade.php ENDPATH**/ ?>