<?php $__env->startSection('content'); ?>
    <h1>Liste des Vendeurs</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('vendeurs.create')); ?>" class="btn-add">Ajouter un vendeur</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $vendeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($vendeur->ID_Vendeur); ?></td>
                    <td><?php echo e($vendeur->nom_prenom); ?></td>
                    <td><?php echo e($vendeur->tel); ?></td>
                    <td><?php echo e($vendeur->mail); ?></td>
                    <td>
                        <a href="<?php echo e(route('vendeurs.show', ['vendeur' => $vendeur->ID_Vendeur])); ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="<?php echo e(route('vendeurs.edit', ['vendeur' => $vendeur->ID_Vendeur])); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="<?php echo e(route('vendeurs.destroy', ['vendeur' => $vendeur->ID_Vendeur])); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun vendeur trouvé.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <?php echo e($vendeurs->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendeurs/index.blade.php ENDPATH**/ ?>