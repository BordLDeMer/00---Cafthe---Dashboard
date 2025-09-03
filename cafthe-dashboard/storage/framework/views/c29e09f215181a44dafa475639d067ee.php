<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: #f8f9fa; color: #000;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #000; font-weight: bold;">Détails de la commande #<?php echo e($commande->ID_commande); ?></h1>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; height: 100%;">
                    <div class="card-body p-0">
                        <div class="p-4" style="background-color: white; color: #000;">
                            <div class="row mb-3">
                                <div class="col-md-4" ><strong>Client:</strong> #<?php echo e($commande->ID_client); ?></div>
                                <div class="col-md-4"><strong>Date:</strong> <?php echo e(optional($commande->created_at)->format('d/m/Y H:i')); ?></div>
                                <div class="col-md-4"><strong>Statut:</strong> <?php echo e(ucfirst(str_replace('_', ' ', $commande->statut))); ?></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4"><strong>Montant total:</strong> <?php echo e(number_format($commande->montant_total ?? 0, 2, ',', ' ')); ?> €</div>
                            </div>

                            <h5 class="mb-3" style="color: #000;">Produits commandés</h5>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="background-color: white; width: 100%;">
                                    <thead style="background-color: white; color: #000;">
                                    <tr>
                                        <th style="padding: 12px; text-align: center;">Produit</th>
                                        <th style="padding: 12px; text-align: center;">Quantité</th>
                                        <th style="padding: 12px; text-align: center;">Prix unitaire</th>
                                        <th style="padding: 12px; text-align: center;">Total ligne</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $commande->produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="padding: 12px; text-align: center;"><?php echo e($produit->designation_produit); ?></td>
                                            <td style="padding: 12px; text-align: center;"><?php echo e($produit->pivot->quantite); ?></td>
                                            <td style="padding: 12px; text-align: center;"><?php echo e(number_format($produit->pivot->prix_unitaire ?? ($produit->prix_ttc ?? 0), 2, ',', ' ')); ?> €</td>
                                            <td style="padding: 12px; text-align: center;"><?php echo e(number_format(($produit->pivot->quantite ?? 0) * ($produit->pivot->prix_unitaire ?? ($produit->prix_ttc ?? 0)), 2, ',', ' ')); ?> €</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-center">
                <a href="<?php echo e(route('commandes.client', $commande->ID_client)); ?>" class="btn" style="background-color: #5a3e2b; color: #fff; border-radius: 10px; padding: 8px 20px; text-decoration: none;">Retour aux commandes du client</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/commandes/details.blade.php ENDPATH**/ ?>