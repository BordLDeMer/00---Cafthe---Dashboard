<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Mon Panier</h1>

        <?php if(Session::has('panier') && count(Session::get('panier')) > 0): ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0 ?>
                <?php $__currentLoopData = Session::get('panier'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $total += $details['prix_ttc'] * $details['quantite'] ?>
                    <tr>
                        <td><?php echo e($details['designation_produit']); ?></td>
                        <td><?php echo e($details['prix_ttc']); ?> €</td>
                        <td><?php echo e($details['quantite']); ?></td>
                        <td><?php echo e($details['prix_ttc'] * $details['quantite']); ?> €</td>
                        <td>
                            <form action="<?php echo e(route('panier.supprimer', $id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th><?php echo e($total); ?> €</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/panier/index.blade.php ENDPATH**/ ?>