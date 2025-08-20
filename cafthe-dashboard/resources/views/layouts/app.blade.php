<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées, CSS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('layouts.navbar') <!-- Inclure la navbar -->

<div class="container mt-4">
    @yield('content') <!-- Contenu de la page -->
</div>

<!-- Scripts JS -->
</body>
</html>
