<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Liste des Clients</h1>
            </div>
            <!-- Message de succès -->
            <?php if(session('success')): ?>
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <!-- Barre de recherche -->
            <div class="col-12 mb-4">
                <form action="<?php echo e(route('clients.index')); ?>" method="GET" class="d-flex justify-content-center">
                    <div class="input-group" style="max-width: 500px; width: 100%;">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Rechercher par ID ou Nom/Prénom..."
                            value="<?php echo e(request('search')); ?>"
                            style="border-radius: 10px 0 0 10px; border-right: none; background-color: white; padding: 10px 15px;"
                        >
                        <button
                            type="submit"
                            class="btn"
                            style="background-color: #5a3e2b; color: white; border-radius: 0 10px 10px 0; padding: 10px 20px; border: none;"
                        >
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bouton Ajouter un client -->
            <div class="col-12 mb-4 text-end">
                <a href="<?php echo e(route('clients.create')); ?>" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                    Ajouter un client
                </a>
            </div>
            <!-- Tableau des clients -->
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0" style="background-color: white; width: 100%;">
                                <thead style="background-color: #5a3e2b; color: white;">
                                <tr>
                                    <th style="padding: 12px; text-align: center;">ID</th>
                                    <th style="padding: 12px; text-align: center;">Nom Prénom</th>
                                    <th style="padding: 12px; text-align: center;">Téléphone</th>
                                    <th style="padding: 12px; text-align: center;">Email</th>
                                    <th style="padding: 12px; text-align: center;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td style="padding: 12px; text-align: center;"><?php echo e($client->ID_client); ?></td>
                                        <td style="padding: 12px; text-align: center;"><?php echo e($client->nom_prenom); ?></td>
                                        <td style="padding: 12px; text-align: center;"><?php echo e($client->tel); ?></td>
                                        <td style="padding: 12px; text-align: center;"><?php echo e($client->mail); ?></td>
                                        <td style="padding: 12px; text-align: center;">
                                            <a href="<?php echo e(route('clients.show', $client->ID_client)); ?>" class="btn" style="background-color: #ccbba7; color: #5a3e2b; border-radius: 5px; padding: 5px 10px; text-decoration: none; margin-right: 5px;">
                                                Voir
                                            </a>
                                            <a href="<?php echo e(route('clients.edit', $client->ID_client)); ?>" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none; margin-right: 5px;">
                                                Modifier
                                            </a>
                                            <a href="<?php echo e(route('commandes.client', $client->ID_client)); ?>" class="btn btn-primary" style="border-radius: 5px; padding: 5px 10px; text-decoration: none; margin-right: 5px; background-color: #82c46c; color: white;">
                                                Commandes
                                            </a>
                                            <form action="<?php echo e(route('clients.destroy', $client->ID_client)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn" style="background-color: #dc3545; color: white; border-radius: 5px; padding: 5px 10px; border: none;" onclick="return confirm('Êtes-vous sûr ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center" style="padding: 12px;">Aucun client trouvé.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                <?php echo e($clients->links('vendor.pagination.bootstrap-4')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/clients/index.blade.php ENDPATH**/ ?>