<?php $__env->startSection('title', 'Gestion des Clients'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <!-- Titre et actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestion des Clients</h1>
        </div>

        <!-- Boutons et recherche -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterClientModal">
                <i class="bi bi-person-plus-fill me-2"></i> Ajouter un client
            </button>
            <div class="input-group" style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un client..." aria-label="Rechercher un client">
                <button class="btn btn-outline-secondary" type="button" aria-label="Rechercher">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <!-- Tableau des clients -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Liste des clients</h5>
            </div>
            <div class="card-body">
                <!-- Messages de succès -->
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Messages d'erreur -->
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Erreurs de validation -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom et Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($client->ID_client); ?></td>
                                <td><?php echo e($client->nom_prenom); ?></td>
                                <td><?php echo e($client->tel ?? 'N/A'); ?></td>
                                <td><?php echo e($client->mail); ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Bouton Éditer -->
                                        <button class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editerClientModal"
                                                data-id="<?php echo e($client->ID_client); ?>"
                                                data-nom="<?php echo e($client->nom_prenom); ?>"
                                                data-tel="<?php echo e($client->tel ?? ''); ?>"
                                                data-mail="<?php echo e($client->mail); ?>"
                                                aria-label="Éditer le client <?php echo e($client->nom_prenom); ?>">
                                            <i class="bi bi-pencil-square"></i> Éditer
                                        </button>

                                        <!-- Bouton Supprimer -->
                                        <form action="<?php echo e(route('clients.destroy', $client->ID_client)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')"
                                                    aria-label="Supprimer le client <?php echo e($client->nom_prenom); ?>">
                                                <i class="bi bi-trash-fill"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                                    Aucun client trouvé.
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Message si aucun résultat après recherche -->
                <div id="noResultsMessage" class="text-center py-4" style="display: none;">
                    <i class="bi bi-search me-2"></i>
                    Aucun client ne correspond à votre recherche.
                </div>
            </div>
        </div>

        <!-- Modal pour AJOUTER un client -->
        <div class="modal fade" id="ajouterClientModal" tabindex="-1" aria-labelledby="ajouterClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajouterClientModalLabel">Ajouter un client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo e(route('clients.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nom_prenom" class="form-label">Nom et Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['nom_prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="nom_prenom" name="nom_prenom" value="<?php echo e(old('nom_prenom')); ?>" required>
                                <?php $__errorArgs = ['nom_prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="tel" name="tel" value="<?php echo e(old('tel')); ?>">
                                <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="mail" name="mail" value="<?php echo e(old('mail')); ?>" required>
                                <?php $__errorArgs = ['mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="mdp" name="mdp" required>
                                <div class="form-text">Le mot de passe sera sécurisé avant enregistrement.</div>
                                <?php $__errorArgs = ['mdp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal pour ÉDITER un client -->
        <div class="modal fade" id="editerClientModal" tabindex="-1" aria-labelledby="editerClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editerClientModalLabel">Éditer un client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editClientForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-body">
                            <input type="hidden" name="ID_client" id="editId">
                            <div class="mb-3">
                                <label for="editNom" class="form-label">Nom et Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editNom" name="nom_prenom" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTel" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="editTel" name="tel">
                            </div>
                            <div class="mb-3">
                                <label for="editMail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="editMail" name="mail" required>
                            </div>
                            <div class="mb-3">
                                <label for="editMdp" class="form-label">Nouveau mot de passe (optionnel)</label>
                                <input type="password" class="form-control" id="editMdp" name="mdp">
                                <div class="form-text">Laissez vide pour conserver l'ancien mot de passe.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        // Recherche en temps réel avec debounce pour optimiser les performances
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const noResultsMessage = document.getElementById('noResultsMessage');

        searchInput.addEventListener('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch();
            }, 300); // Attendre 300ms après la dernière saisie
        });

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const rows = document.querySelectorAll('tbody tr:not(.no-results)');
            let visibleRows = 0;

            rows.forEach(row => {
                // Éviter les erreurs si les cellules n'existent pas
                const nomCell = row.querySelector('td:nth-child(2)');
                const telCell = row.querySelector('td:nth-child(3)');
                const mailCell = row.querySelector('td:nth-child(4)');

                if (nomCell && telCell && mailCell) {
                    const nomPrenom = nomCell.textContent.toLowerCase();
                    const tel = telCell.textContent.toLowerCase();
                    const mail = mailCell.textContent.toLowerCase();

                    if (nomPrenom.includes(searchTerm) ||
                        tel.includes(searchTerm) ||
                        mail.includes(searchTerm)) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                }
            });

            // Afficher/masquer le message "aucun résultat"
            if (visibleRows === 0 && searchTerm !== '' && rows.length > 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        }

        // Remplissage du formulaire d'édition
        const editerClientModal = document.getElementById('editerClientModal');
        if (editerClientModal) {
            editerClientModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                // Vérifier que le bouton existe et a les attributs nécessaires
                if (button) {
                    const id = button.getAttribute('data-id');
                    const nom = button.getAttribute('data-nom');
                    const tel = button.getAttribute('data-tel');
                    const mail = button.getAttribute('data-mail');

                    const form = editerClientModal.querySelector('form');
                    if (form && id) {
                        form.action = `/clients/${id}`;
                    }

                    // Remplir les champs du formulaire
                    const editId = editerClientModal.querySelector('#editId');
                    const editNom = editerClientModal.querySelector('#editNom');
                    const editTel = editerClientModal.querySelector('#editTel');
                    const editMail = editerClientModal.querySelector('#editMail');
                    const editMdp = editerClientModal.querySelector('#editMdp');

                    if (editId) editId.value = id || '';
                    if (editNom) editNom.value = nom || '';
                    if (editTel) editTel.value = tel || '';
                    if (editMail) editMail.value = mail || '';
                    if (editMdp) editMdp.value = '';
                }
            });
        }

        // Réinitialiser le formulaire d'ajout quand le modal se ferme
        const ajouterClientModal = document.getElementById('ajouterClientModal');
        if (ajouterClientModal) {
            ajouterClientModal.addEventListener('hidden.bs.modal', function () {
                const form = this.querySelector('form');
                if (form) {
                    form.reset();
                    // Supprimer les classes de validation Bootstrap
                    form.querySelectorAll('.is-invalid').forEach(input => {
                        input.classList.remove('is-invalid');
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/partials/navbar.blade.php ENDPATH**/ ?>