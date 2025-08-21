<?php $__env->startSection('content'); ?>
    <h1>Modifier le client : <?php echo e($client->nom_prenom); ?></h1>
    <form action="<?php echo e(route('clients.update', $client->ID_client)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="nom_prenom" class="form-label">Nom et Prénom</label>
            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="<?php echo e($client->nom_prenom); ?>" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?php echo e($client->tel); ?>" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?php echo e($client->mail); ?>" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/clients/update.blade.php ENDPATH**/ ?>
