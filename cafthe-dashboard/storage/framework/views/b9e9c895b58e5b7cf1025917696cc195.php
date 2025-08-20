<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées, CSS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <?php
        $viteManifest = public_path('build'.DIRECTORY_SEPARATOR.'manifest.json');
        $hasViteBuild = file_exists($viteManifest);
    ?>
    <?php if($hasViteBuild): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php else: ?>
        <!-- Fallback CSS/JS when Vite build is not available -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <?php endif; ?>
</head>
<body>
<?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <!-- Inclure la navbar -->

<div class="container mt-4">
    <?php echo $__env->yieldContent('content'); ?> <!-- Contenu de la page -->
</div>

<!-- Scripts JS -->
</body>
</html>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/layouts/app.blade.php ENDPATH**/ ?>