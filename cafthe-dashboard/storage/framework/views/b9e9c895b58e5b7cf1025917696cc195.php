<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées, CSS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <!-- Inclure la navbar -->

<div class="container mt-4">
    <?php echo $__env->yieldContent('content'); ?> <!-- Contenu de la page -->
</div>

<!-- Scripts JS -->
</body>
</html>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/layouts/app.blade.php ENDPATH**/ ?>