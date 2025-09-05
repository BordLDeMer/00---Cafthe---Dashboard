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
                <?php ($vendeur = auth('vendeur')->user()); ?>
                <?php if($vendeur): ?>
                    <?php ($chefVal = isset($vendeur->Chef) ? $vendeur->Chef : (isset($vendeur->chef) ? $vendeur->chef : (isset($vendeur->is_chef) ? $vendeur->is_chef : null))); ?>
                    <?php ($isChef = is_bool($chefVal) ? $chefVal : (is_numeric($chefVal) ? ((int)$chefVal === 1) : (is_string($chefVal) ? in_array(strtolower(trim($chefVal)), ['oui','yes','1']) : false))); ?>
                <?php else: ?>
                    <?php ($isChef = false); ?>
                <?php endif; ?>
                <?php if($isChef): ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('vendeurs.index')); ?>">Gestion des Vendeurs</a>
                    </li>
                <?php endif; ?>
                <!-- Lien "Mon Profil" pour tous les vendeurs -->
                <?php if(auth('vendeur')->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('vendeurs.mon_profil')); ?>">Mon Profil</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="<?php echo e(route('produits.index')); ?>">Nos Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="https://reactjs-cafthe.benjamin.bidou.dev-campus.fr/">Notre site</a>
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
                <?php if(auth('vendeur')->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Se déconnecter">
                            <i class="bi bi-person-circle me-1"></i> <?php echo e(auth('vendeur')->user()->nom_prenom ?? 'Vendeur'); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/partials/navbar.blade.php ENDPATH**/ ?>