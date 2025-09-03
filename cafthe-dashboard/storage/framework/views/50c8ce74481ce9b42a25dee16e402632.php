<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px; height: 100%;">
                <div class="card-header" style="background-color: #5a3e2b; color: #fff; border-radius: 10px 10px 0 0;">
                    <strong>Ajouter un produit</strong>
                </div>
                <div class="card-body" style="background-color: #fff">
                    <style>
                        .form-label { color: #000 !important; text-align: left !important; }
                        .form-check-label { color: #000 !important; text-align: left !important; }
                        .form-control { text-align: left; }
                    </style>
                    <form action="<?php echo e(route('produits.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Désignation</label>
                            <input type="text" name="designation_produit" value="<?php echo e(old('designation_produit')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Type de produit</label>
                            <input list="types" name="type_produit" value="<?php echo e(old('type_produit')); ?>" class="form-control">
                            <datalist id="types">
                                <?php if(isset($typesProduits)): ?>
                                    <?php $__currentLoopData = $typesProduits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix TTC (€)</label>
                            <input type="number" step="0.01" min="0" name="prix_ttc" value="<?php echo e(old('prix_ttc')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Rayon</label>
                            <input type="number" name="ID_rayon" value="<?php echo e(old('ID_rayon')); ?>" class="form-control">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <!-- Ensure a value is always submitted: 0 when unchecked, 1 when checked -->
                            <input type="hidden" name="solde" value="0">
                            <input class="form-check-input" type="checkbox" id="solde" name="solde" value="1" <?php echo e(old('solde') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="solde">En solde</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" min="0" name="stock" value="<?php echo e(old('stock', 0)); ?>" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('produits.index')); ?>" class="btn" style="background-color: #6c757d; color: white;">Annuler</a>
                            <button type="submit" class="btn" style="background-color: #82C46C; color: #5a3e2b; font-weight: bold;">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/produits/create.blade.php ENDPATH**/ ?>