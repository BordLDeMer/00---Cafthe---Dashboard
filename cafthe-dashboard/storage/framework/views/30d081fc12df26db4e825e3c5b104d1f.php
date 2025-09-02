<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Mon Panier</h1>
            </div>

            <!-- Message de succès -->
            <?php if(session('success')): ?>
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <!-- Bouton Continuer les achats -->
            <div class="col-12 mb-4 text-end">
                <a href="<?php echo e(route('produits.index')); ?>" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                    Continuer les achats
                </a>
            </div>

            <!-- Tableau des produits dans le panier -->
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; height: auto;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <?php if(Session::has('panier') && count(Session::get('panier')) > 0): ?>
                                <table class="table table-striped mb-0" style="background-color: white; width: 100%;">
                                    <thead style="background-color: #5a3e2b; color: white;">
                                    <tr>
                                        <th style="padding: 12px; text-align: center;">Produit</th>
                                        <th style="padding: 12px; text-align: center;">Prix unitaire</th>
                                        <th style="padding: 12px; text-align: center;">Quantité</th>
                                        <th style="padding: 12px; text-align: center;">Total</th>
                                        <th style="padding: 12px; text-align: center;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0 ?>
                                    <?php $__currentLoopData = Session::get('panier'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $total += $details['prix_ttc'] * $details['quantite'] ?>
                                        <tr>
                                            <td style="padding: 12px; text-align: center;"><?php echo e($details['designation_produit']); ?></td>
                                            <td style="padding: 12px; text-align: center;"><?php echo e(number_format($details['prix_ttc'], 2)); ?> €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <span class="badge" style="background-color: #5a3e2b; color: white; padding: 5px 10px; border-radius: 5px;">
                                                    <?php echo e($details['quantite']); ?>

                                                </span>
                                            </td>
                                            <td style="padding: 12px; text-align: center;"><?php echo e(number_format($details['prix_ttc'] * $details['quantite'], 2)); ?> €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <form action="<?php echo e(route('panier.supprimer', $id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn" style="background-color: #dc3545; color: white; border-radius: 5px; padding: 5px 10px; border: none;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit du panier ?')">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot style="background-color: #f8f9fa;">
                                    <tr>
                                        <td colspan="3" style="padding: 12px; text-align: right; font-weight: bold;">Total:</td>
                                        <td style="padding: 12px; text-align: center; font-weight: bold;"><?php echo e(number_format($total, 2)); ?> €</td>
                                        <td style="padding: 12px; text-align: center;">
                                            <form action="<?php echo e(route('panier.valider')); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn" style="background-color: #82C46C; color: #5a3e2b; border-radius: 5px; padding: 8px 15px; border: none; font-weight: bold;" onclick="return confirm('Êtes-vous sûr de vouloir valider cet achat ?')">
                                                    <i class="bi bi-check-lg"></i> Valider l'achat
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            <?php else: ?>
                                <div class="card" style="background-color: white; border: none;">
                                    <div class="card-body text-center p-5">
                                        <i class="bi bi-cart-x" style="font-size: 3rem; color: #5a3e2b; margin-bottom: 1rem;"></i>
                                        <h3 style="color: #5a3e2b;">Votre panier est vide</h3>
                                        <p style="color: #5a3e2b; margin-bottom: 2rem;">Ajoutez des produits à votre panier pour passer commande.</p>
                                        <a href="<?php echo e(route('produits.index')); ?>" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 10px 20px; border: none; font-weight: bold;">
                                            <i class="bi bi-bag-plus"></i> Voir nos produits
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/panier/index.blade.php ENDPATH**/ ?>