<nav class="navbar  navbar-expand-lg navbar-dark">
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
                        <a class="nav-link fs-5 ps-4 text-white" href="{{ route('clients.index') }}">Gestion des Clients</a>
                        <a class="nav-link fs-5 ps-4 text-white" href="{{ route('vendeurs.index') }}">Gestion des Vendeurs</a>
                        <a class="nav-link fs-5 ps-4 text-white" href="https://reactjs-cafthe.benjamin.bidou.dev-campus.fr/">Nos produits</a>
                <!-- Ajoutez d'autres liens ici -->
            </ul>

            <!-- Éléments à droite (utilisateur, déconnexion, etc.) -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mon profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
