<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- Logo ou nom de l'application -->
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e(asset('images/lolgo.png')); ?>" alt="Logo" class="img-fluid d-inline-block align-top" width="70" height="70">
            Caf'thé
        </a>
        <!-- Bouton pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('clients.index')); ?>">Gestion des Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('vendeurs.index')); ?>">Gestion des Vendeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('produits.index')); ?>">Nos Produits</a>
                </li>
            </ul>
            <!-- Éléments à droite (panier, utilisateur, déconnexion, etc.) -->
            <ul class="navbar-nav d-flex align-items-center">
                <!-- Lien vers le panier -->
                <li class="nav-item me-3 position-relative">
                    <a class="nav-link text-white" href="<?php echo e(route('panier.voir')); ?>">
                        <i class="bi bi-cart fs-4"></i>
                        <?php if(Session::has('panier') && count(Session::get('panier')) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo e(count(Session::get('panier'))); ?>

                            </span>
                        <?php endif; ?>
                    </a>
                </li>
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