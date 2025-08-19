<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Dashboard</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

</head>
<body>
<div class="navbar">
    <div>
        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">Accueil</a>
        <a class="nav-link" href="<?php echo e(route('clients.index')); ?>">Gestion des Clients</a>
        <a class="nav-link" href="<?php echo e(route('vendeurs.index')); ?>">Gestion des Vendeurs</a>
        <a href="#">Nos produits</a>

    </div>
</div>
<div class="dashboard">
    <div class="card">
        <h2>CHIFFRE AFFAIRE MOIS</h2>
        <h1><?php echo e(number_format($chiffreAffairesMois['total'], 2, ',', ' ')); ?> €</h1>
    </div>
    <div class="card">
        <h2>BALANCE MENSUELLE</h2>
        <p><strong>CA mois dernier :</strong> <?php echo e(number_format($balanceMensuelle['ca_mois_precedent'], 2, ',', ' ')); ?> €</p>
        <h1>
            <?php if($balanceMensuelle['balance'] >= 0): ?>
                <span style="color: green;">+<?php echo e(number_format($balanceMensuelle['balance'], 2, ',', ' ')); ?> €</span>
            <?php else: ?>
                <span style="color: red;"><?php echo e(number_format($balanceMensuelle['balance'], 2, ',', ' ')); ?> €</span>
            <?php endif; ?>
        </h1>
    </div>

    <div class="card">
        <h2>MEILLEURE VENTE</h2>
        <?php echo $__env->make('product-card', ['produit' => $meilleureVente ?? null, 'titre' => 'Meilleure vente'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="card">
        <h2>PRODUIT EN RECUL</h2>
        <?php echo $__env->make('product-card', ['produit' => $mauvaiseVente ?? null, 'titre' => 'Produit en recul'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

</div>
</div>

</body>
</html>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/dashboard.blade.php ENDPATH**/ ?>