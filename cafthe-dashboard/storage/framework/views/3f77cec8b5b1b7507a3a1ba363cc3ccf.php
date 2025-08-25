<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Liste des Vendeurs</h1>
            </div>
            <!-- Message de succès -->
            <?php if(session('success')): ?>
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>
            <!-- Bouton Ajouter un vendeur -->
            <div class="col-12 mb-4 text-end">
                <a href="<?php echo e(route('vendeurs.create')); ?>" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                    Ajouter un vendeur
                </a>
            </div>
            <!-- Tableau des vendeurs -->
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="ta

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>