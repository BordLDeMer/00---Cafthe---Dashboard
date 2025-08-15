<div class="modal fade" id="editerClientModal" tabindex="-1" aria-labelledby="editerClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editerClientModalLabel">Éditer un client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editClientForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="ID_client" id="editId">
                    <div class="mb-3">
                        <label for="editNom" class="form-label">Nom et Prénom</label>
                        <input type="text" class="form-control" id="editNom" name="nom_prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTel" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="editTel" name="tel">
                    </div>
                    <div class="mb-3">
                        <label for="editMail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editMail" name="mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMdp" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="editMdp" name="mdp">
                        <div class="form-text">Laisser vide pour ne pas changer le mot de passe.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
