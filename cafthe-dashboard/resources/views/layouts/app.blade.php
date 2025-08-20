<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées, CSS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @php
        $viteManifest = public_path('build'.DIRECTORY_SEPARATOR.'manifest.json');
        $hasViteBuild = file_exists($viteManifest);
    @endphp
    @if($hasViteBuild)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS/JS when Vite build is not available -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    @endif
</head>
<body>
@include('partials.navbar') <!-- Inclure la navbar -->

<div class="container mt-4">
    @yield('content') <!-- Contenu de la page -->
</div>

<!-- Scripts JS -->
</body>
</html>
