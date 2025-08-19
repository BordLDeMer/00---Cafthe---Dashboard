<?php $__env->startSection('content'); ?>
    <h1>Liste des Clients</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('clients.create')); ?>" class="btn btn-primary mb-3">Ajouter un client</a>

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
            <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($client->ID_client); ?></td>
                    <td><?php echo e($client->nom_prenom); ?></td>
                    <td><?php echo e($client->tel); ?></td>
                    <td><?php echo e($client->mail); ?></td>
                    <td>
                        <a href="<?php echo e(route('clients.show', $client->ID_client)); ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="<?php echo e(route('clients.edit', $client->ID_client)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="<?php echo e(route('clients.destroy', $client->ID_client)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun client trouvé.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Liens de pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($clients->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/clients/index.blade.php ENDPATH**/ ?>