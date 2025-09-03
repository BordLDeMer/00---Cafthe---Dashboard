<?php $__env->startSection('content'); ?>
    <title>Café Dashboard</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Tableau de bord Cafthé</h1>
                <?php if($produitsFaibleStock->isNotEmpty()): ?>
                    <p style="color: red; font-weight: bold; margin-top: 10px;">
                        ⚠️ Attention : <?php echo e($produitsFaibleStock->count()); ?> produit(s) en rupture de stock !
                    </p>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-80" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">CA DU MOIS</h5>
                        <h2 class="card-text" style="color: #5a3e2b;"><?php echo e(number_format($chiffreAffairesMois['total'], 2, ',', ' ')); ?> €</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-80" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">BALANCE MENSUELLE</h5>
                        <p class="card-text" style="color: #5a3e2b;"><strong>CA mois dernier :</strong> <?php echo e(number_format($balanceMensuelle['ca_mois_precedent'], 2, ',', ' ')); ?> €</p>
                        <h2 class="card-text">
                            <?php if($balanceMensuelle['balance'] >= 0): ?>
                                <span style="color: green; ">+<?php echo e(number_format($balanceMensuelle['balance'], 2, ',', ' ')); ?> €</span>
                            <?php else: ?>
                                <span style="color: red;"><?php echo e(number_format($balanceMensuelle['balance'], 2, ',', ' ')); ?> €</span>
                            <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-80" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">MEILLEURE VENTE</h5>
                        <?php echo $__env->make('product-card', ['produit' => $meilleureVente ?? null, 'titre' => 'Meilleure vente'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-80" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">PRODUIT EN RECUL</h5>
                        <?php echo $__env->make('product-card', ['produit' => $mauvaiseVente ?? null, 'titre' => 'produits en recul'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelle section pour les produits en faible stock -->
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px; width: 100%; height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center" style="color: #5a3e2b;">PRODUITS EN RUPTURE DE STOCK (STOCK < 5)</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" style="color: #5a3e2b;">Nom</th>
                                    <th scope="col" style="color: #5a3e2b;">Stock</th>
                                    <th scope="col" style="color: #5a3e2b;">Prix</th>
                                    <th scope="col" style="color: #5a3e2b;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $produitsFaibleStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr style="background-color: #f8f9fa;"">
                                        <td style="color: #5a3e2b;"><?php echo e($produit->designation_produit); ?></td>
                                        <td style="color: #5a3e2b;"><?php echo e($produit->stock); ?></td>
                                        <td style="color: #5a3e2b;"><?php echo e(number_format($produit->prix_ttc, 2, ',', ' ')); ?> €</td>
                                        <td>
                                            <a href="<?php echo e(route('produits.edit', $produit)); ?>" class="btn btn-sm" style="background-color: #5a3e2b; color: white;">Modifier</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="color: #5a3e2b;">Aucun produit en rupture de stock.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/dashboard.blade.php ENDPATH**/ ?>