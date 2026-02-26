<div class="container mt-5">

    <h1 class="mb-4 text-center">Gestion des Étudiants</h1>
    <br>
    <!-- INSCRIPTION -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Inscrire un étudiant
        </div>
        <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
            <span class="alert alert-success text-center">
                Étudiant inscrit avec succès.
            </span>
        <?php endif?>    

        <?php if(isset($_GET['erreur'])):?>
            <span class="alert alert-danger text-center">      
                    Veuillez bien remplir tous les champs du formulaire.
            </span>  
         <?php endif?>
        <div class="card-body">
            <form action=<?= $action ?> method="POST">             
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" name="matricule" class="form-control" readonly placeholder="Générer automatiquement" >
                    </div>                       
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Date de naissance</label>
                    <input type="date" name="dateNaiss" class="form-control" required>
                </div>      

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Niveau</label>
                        <select class="niveau form-select" name="id_niveau" required>
                            <option value="">-- Choisir un niveau --</option>
                            <?php foreach($niveaux as $n): ?>
                                <option value="<?= $n['id_niveau'] ?>">
                                    <?= $n['nomNiveau'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>                       
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Classe</label>
                            <select class="classe form-select" name="id_classe" required>
                                <option value="">-- Choisir une classe --</option>
                            </select>
                    </div>  
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Année académique</label>
                        <input type="text" name="anacad" class="form-control" required placeholder="EX : 2001">
                    </div>      
                </div>

                <button type="submit" name="inscrire" class="btn btn-success">
                      Inscrire l'étudiant
                </button>
            </form>
        </div>
    </div>

    <!-- LISTE ETUDIANTS PAR CLASSE -->
    <div id="affiche" class="card shadow mb-4">
        <div  class="card-header bg-dark text-white">
            Liste des étudiants d'une classe
        </div>
        <div class="card-body">

            <form action=<?= $action ?> method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <select class="niveau form-select" name="id_niveau">
                            <option value="">-- Choisir un niveau --</option>
                            <?php foreach($niveaux as $n): ?>
                                <option value="<?= $n['id_niveau'] ?>">
                                    <?= $n['nomNiveau'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>                       
                    </div>

                    <div class="col-md-4 mb-3">
                            <select class="classe form-select" name="id_classe">
                                <option value="">-- Choisir une classe --</option>
                            </select>
                    </div>  
                    
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit" name="afficherEtud">
                            Afficher
                        </button>
                    </div>
                </div>
            </form>

            <!-- TABLE de Données -->
            <table class="table table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($etudiantsNiveau as $en):?>
                        <tr>
                            <td><?= $en['matricule'] ?></td>
                            <td><?= $en['NomEtud'] ?></td>
                            <td><?= $en['PrenomEtud'] ?></td>
                            <td><?= $en['datenaiss'] ?></td>
                        </tr>
                    <?php endforeach?>    
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <a href="?page=etudiants&btt=bec#af2" class="btn btn-success  me-2">Meilleur étudiant d'une classe</a>
            <a href="?page=etudiants&btt=ben#af3" class="btn btn-warning ">Meilleur étudiant d'un niveau</a>
            <a href="?page=etudiants&btt=bemc#af4" class="btn btn-danger me-2">Étudiants au-dessus de la moyenne de leur classe</a>  
        </div>        
    </div>

    <!-- MEILLEUR ETUDIANT CLASSE -->
    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'bec'): ?>
        <br>
        <br>
        <div id="af2" class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                Meilleur étudiant d'une classe
            </div>
            <div class="card-body">

                <form action=<?= $action ?> method="POST" class="mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <select class="niveau form-select" name="id_niveau">
                                <option value="">-- Choisir un niveau --</option>
                                <?php foreach($niveaux as $n): ?>
                                    <option value="<?= $n['id_niveau'] ?>">
                                        <?= $n['nomNiveau'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>

                        <div class="col-md-4 mb-3">
                                <select class="classe form-select" name="id_classe">
                                    <option value="">-- Choisir une classe --</option>
                                </select>
                        </div>                     
                        <div class="col-md-3">
                            <button class="btn btn-success" type="submit" name="bestEtudClass">
                                Afficher
                            </button>
                        </div>
                    </div>
                </form>

                <div class="alert alert-info">
                    <strong>Nom : </strong> <?= isset($bestEtudClasse) && !empty($bestEtudClasse) ? $bestEtudClasse['NomEtud']." ".$bestEtudClasse['PrenomEtud'] : "Aucun étudiant trouvé" ?> <br>
                    <strong>Moyenne : </strong> <?= isset($bestEtudClasse) && !empty($bestEtudClasse) ? $bestEtudClasse['moyenne'] : "0.00" ?>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <!-- MEILLEUR ETUDIANT NIVEAU -->

    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'ben'): ?>
        <br>
        <br>
        <div id="af3" class="card shadow mb-4">
            <div class="card-header bg-warning text-dark">
                Meilleur étudiant d'un niveau
            </div>
            <div class="card-body">

                <form action=<?= $action ?> method="POST" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select" name="id_niveau">
                                <option value="">-- Choisir un niveau --</option>
                                <?php foreach($niveaux as $n): ?>
                                    <option value="<?= $n['id_niveau'] ?>">
                                        <?= $n['nomNiveau'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-warning" type="submit" name="bestEtudNiveau">
                                Afficher
                            </button>
                        </div>
                    </div>
                </form>

                <div class="alert alert-warning text-dark">
                    <strong>Nom :</strong> <?= isset($bestEtudNiveau) && !empty($bestEtudNiveau) ? $bestEtudNiveau['NomEtud']." ".$bestEtudNiveau['PrenomEtud'] : "Aucun étudiant trouvé" ?> <br>
                    <strong>Classe :</strong> <?= isset($bestEtudNiveau) && !empty($bestEtudNiveau) ? $bestEtudNiveau['nomClasse'] : "Aucune classe trouvée" ?> <br>
                    <strong>Moyenne :</strong> <?= isset($bestEtudNiveau) && !empty($bestEtudNiveau) ? $bestEtudNiveau['moyenne'] : "0.00" ?>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <!-- ETUDIANTS SUP MOYENNE CLASSE -->
    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'bemc'): ?>
        <br>
        <br>
        <div id="af4" class="card shadow mb-4">
            <div class="card-header bg-danger text-white">
                Étudiants au-dessus de la moyenne de leur classe
            </div>
            <div class="card-body">
                <form action=<?= $action ?> method="POST" class="mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <select class="niveau form-select" name="id_niveau">
                                <option value="">-- Choisir un niveau --</option>
                                <?php foreach($niveaux as $n): ?>
                                    <option value="<?= $n['id_niveau'] ?>">
                                        <?= $n['nomNiveau'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>

                        <div class="col-md-4 mb-3">
                                <select class="classe form-select" name="id_classe">
                                    <option value="">-- Choisir une classe --</option>
                                </select>
                        </div>                     
                        <div class="col-md-3">
                            <button class="btn btn-danger" type="submit" name="afficherSupMoy">
                                Afficher
                            </button>
                        </div>
                    </div>  
                </form>

                <table class="table table-striped text-center">
                    <thead class="table-danger">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Classe</th>
                            <th>Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($etudSupMoyClass as $esmc):?>
                            <?php if(isset($_GET['id_classe']) && $esmc['id_classe'] == $_GET['id_classe']): ?>
                                <tr>
                                    <td><?= $esmc['matricule'] ?></td>
                                    <td><?= $esmc['NomEtud']." ".$esmc['PrenomEtud'] ?></td>
                                    <td><?= getCodeNiveau(getIdNivClass($esmc['id_classe']))." ".getCodeClasse($esmc['id_classe']) ?></td>
                                    <td><?= number_format(getMoyenneEtudiant($esmc['id_etudiant']),2) ?></td>
                                </tr>
                        <?php endif; endforeach?>
                    </tbody>
                </table>

            </div>
        </div>
    <?php endif; ?>

</div>
