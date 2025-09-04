<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- Logo ou nom de l'application -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/lolgo.png') }}" alt="Logo" class="img-fluid d-inline-block align-top" width="70" height="70">
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
                    <a class="nav-link fs-5 ps-4 text-white" href="{{ route('clients.index') }}">Gestion des Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="{{ route('vendeurs.index') }}">Gestion des Vendeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="{{ route('produits.index') }}">Nos Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 ps-4 text-white" href="https://reactjs-cafthe.benjamin.bidou.dev-campus.fr/">Notre site</a>
                </li>
            </ul>
            <!-- Éléments à droite (panier, utilisateur, déconnexion, etc.) -->
            <ul class="navbar-nav d-flex align-items-center">
                <!-- Lien vers le panier -->
                <li class="nav-item me-3 position-relative">
                    <a class="nav-link text-white" href="{{ route('panier.voir') }}">
                        <i class="bi bi-cart fs-4"></i>
                        @if(Session::has('panier') && count(Session::get('panier')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count(Session::get('panier')) }}
                            </span>
                        @endif
                    </a>
                </li>
                @if(auth('vendeur')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ auth('vendeur')->user()->nom_prenom ?? 'Vendeur' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('vendeurs.edit', auth('vendeur')->user()->getKey()) }}">Mon profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
