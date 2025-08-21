<nav class="navbar  navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- Logo ou nom de l'application -->
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <i class="bi bi-house-door-fill me-2"></i>
            Mon Application
        </a>

        <!-- Bouton pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                        <a class="nav-link" href="<?php echo e(route('clients.index')); ?>">Gestion des Clients</a>
                        <a class="nav-link" href="<?php echo e(route('vendeurs.index')); ?>">Gestion des Vendeurs</a>
                        <a class="nav-link" href="https://reactjs-cafthe.benjamin.bidou.dev-campus.fr/">Nos produits</a>
                <!-- Ajoutez d'autres liens ici -->
            </ul>

            <!-- Éléments à droite (utilisateur, déconnexion, etc.) -->
            <ul class="navbar-nav">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Mon profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/partials/navbar.blade.php ENDPATH**/ ?>