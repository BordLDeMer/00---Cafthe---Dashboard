<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
         <!--   <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Liste des produits</h1>
            </div>
        -->
            <!-- Barre de filtrage -->
            <div class="col-12 mb-4">
                <div class="card" style="background-color: #82C46C; border: none; border-radius: 10px; width:100%; height: auto;">
                    <div class="card-body">
                        <form method="GET" action="<?php echo e(route('produits.index')); ?>">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select name="solde" class="form-control" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                        <option value="">Tous les produits</option>
                                        <option value="1" <?php echo e(request('solde') == '1' ? 'selected' : ''); ?>>En solde</option>
                                        <option value="0" <?php echo e(request('solde') == '0' ? 'selected' : ''); ?>>Pas en solde</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="type_produit" class="form-control" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                        <option value="">Tous les types</option>
                                        <?php $__currentLoopData = $typesProduits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type); ?>" <?php echo e(request('type_produit') == $type ? 'selected' : ''); ?>>
                                                <?php echo e($type); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="prix_max" class="form-control" placeholder="Prix maximum" value="<?php echo e(request('prix_max')); ?>" step="10" min="0" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn w-100" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 20px; border: none;">
                                        Filtrer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Liste des produits -->
            <div class="col-12">
                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
                                <div class="card-header" style="background-color: #5a3e2b; color: white; border: none; padding: 15px;">
                                    <h5 class="card-title mb-0" style="font-weight: bold; text-align: center;"><?php echo e($produit->designation_produit); ?></h5>
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 15px;">
                                    <div class="flex-grow-1; text-align:left; ">
                                        <p class="card-text mb-2 text-start ms-3">
                                            <strong>Type:</strong> <span style="color: #5a3e2b;"><?php echo e($produit->type_produit); ?></span>
                                        </p>
                                        <p class="card-text mb-2 text-start ms-3">
                                            <strong>Prix:</strong> <span style="color: #5a3e2b; font-weight: bold; font-size: 1.1em;"><?php echo e($produit->prix_ttc); ?> €</span>
                                        </p>
                                        <p class="card-text mb-2 text-start ms-3">
                                            <strong>Stock:</strong>
                                            <span class="<?php echo e($produit->stock > 0 ? 'text-success' : 'text-danger'); ?>" style="font-weight: bold;">
                                                <?php echo e($produit->stock); ?>

                                            </span>
                                        </p>
                                        <?php if($produit->solde): ?>
                                            <div class="mb-3">
                                                <span class="badge" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px;">
                                                    En solde
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-auto">
                                        <?php if($produit->stock > 0): ?>
                                            <form action="<?php echo e(route('panier.ajouter', $produit->ID_produit)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn w-100" style="background-color: #28a745; color: white; border-radius: 5px; padding: 8px; border: none; font-weight: bold;">
                                                    Ajouter au panier
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn w-100" disabled style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px; border: none;">
                                                Stock épuisé
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                                <div class="card-body text-center" style="padding: 40px;">
                                    <h3 style="color: #5a3e2b;">Aucun produit trouvé</h3>
                                    <p style="color: #5a3e2b;">Essayez de modifier vos filtres pour voir plus de produits.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pagination (seulement si $produits est paginé) -->
            <?php if(method_exists($produits, 'hasPages') && $produits->hasPages()): ?>
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <div class="pagination-wrapper">
                        <?php echo e($produits->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        /* Style pour la pagination */
        .pagination-wrapper .pagination {
            margin: 0;
        }
        .pagination-wrapper .page-link {
            color: #5a3e2b;
            background-color: white;
            border-color: #ccbba7;
            border-radius: 5px;
            margin: 0 2px;
        }
        .pagination-wrapper .page-link:hover {
            color: white;
            background-color: #5a3e2b;
            border-color: #5a3e2b;
        }
        .pagination-wrapper .page-item.active .page-link {
            color: white;
            background-color: #5a3e2b;
            border-color: #5a3e2b;
        }
        .pagination-wrapper .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        /* Effet hover sur les cartes */
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
        }

        /* Style pour les filtres */
        .form-control:focus {
            border-color: #5a3e2b;
            box-shadow: 0 0 0 0.2rem rgba(90, 62, 43, 0.25);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/produits/index.blade.php ENDPATH**/ ?>