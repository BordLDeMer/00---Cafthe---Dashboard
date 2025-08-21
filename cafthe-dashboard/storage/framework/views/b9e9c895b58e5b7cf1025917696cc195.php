<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Mon Application'); ?></title>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Votre CSS personnalisé -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: linen;
            margin: 0;
            padding: 0;
        }
        .dashboard {
            display: wrap;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>
<body>
<?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="dashboard">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/layouts/app.blade.php ENDPATH**/ ?>