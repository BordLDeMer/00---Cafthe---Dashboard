<?php $__env->startSection('content'); ?>
    <title>Café Dashboard</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Tableau de bord Cafthé</h1>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">CA DU MOIS</h5>
                        <h2 class="card-text" style="color: #5a3e2b;"><?php echo e(number_format($chiffreAffairesMois['total'], 2, ',', ' ')); ?> €</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
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
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">MEILLEURE VENTE</h5>
                        <?php echo $__env->make('product-card', ['produit' => $meilleureVente ?? null, 'titre' => 'Meilleure vente'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">PRODUIT EN RECUL</h5>
                        <?php echo $__env->make('product-card', ['produit' => $mauvaiseVente ?? null, 'titre' => 'Produit en recul'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/dashboard.blade.php ENDPATH**/ ?>